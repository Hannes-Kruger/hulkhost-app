<?php

namespace App\Livewire\Components;

use App\Rules\SouthAfricanVatNumber;
use App\Rules\UniqueCompanyName;
use App\Services\SageOne;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Onboard extends Component
{
    public array $emails = [];

    public string $companyName = '';

    public string $vatNumber = '';

    public string $newEmail = '';

    public string $sageId = 'e';

    #[Computed]
    public bool $allowMoreEmails = true;

    public function mount()
    {
        $this->emails = [
            auth()->user()->email,
        ];

        $this->setComputedProp();
    }

    public function removeEmail($email)
    {
        $index = array_search($email, $this->emails);
        if ($index !== false) {
            unset($this->emails[$index]);
        }

        $this->setComputedProp();
    }

    public function addEmail()
    {
        $this->validate([
            'newEmail' => 'required|email:dns,rfc',
        ]);

        if (! in_array($this->newEmail, $this->emails)) {
            $this->emails[] = $this->newEmail;
        }

        $this->newEmail = '';

        $this->setComputedProp();
        $this->modal('add-invoice-email')->close();

    }

    public function setComputedProp()
    {
        $this->allowMoreEmails = count($this->emails) < 5;
    }

    public function saveChanges()
    {
        $this->validate([
            'emails' => 'required|array|min:1|max:5',
            'emails.*' => 'required|email:dns,rfc',
            'companyName' => ['required', 'string', 'min:3', 'max:100', new UniqueCompanyName],
            'vatNumber' => [new SouthAfricanVatNumber],
        ]);

        $data = [
            'Email' => collect($this->emails)->implode(','),
            'TaxReference' => $this->vatNumber,
            'Name' => $this->companyName,
            'PostalAddress05' => 'South Africa',
            'CommunicationMethod' => 1,
            'Active' => true,
            'AutoAllocateToOldestInvoice' => true,
            'EnableCustomerZone' => false,
        ];

        $sage = new SageOne;

        $response = $sage->createCustomer($data);

        auth()->user()->currentTeam()->update([
            'sage_id' => $response['ID'],
        ]);

        $team = auth()->user()->currentTeam;

        $team->forceFill([
            'name' => $this->companyName,
        ])->save();

        $this->redirectRoute('dashboard');
    }

    public function render()
    {
        return view('components.onboard');
    }
}
