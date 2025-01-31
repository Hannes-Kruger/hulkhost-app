<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'personal_team',
        'sage_id',
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'personal_team' => 'boolean',
        ];
    }

    /**
     * Boot the model and add event listeners.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            if (empty($model->account_ref)) {
                $model->account_ref = $model->generateUniqueAccountRef();
            }
        });
    }

    /**
     * Generate a unique account reference string.
     */
    private function generateUniqueAccountRef(): string
    {
        do {
            $prefix = strtoupper(substr($this->name ?? 'ACCOUNT', 0, 3));
            $suffix = str_pad(mt_rand(1, 999), 4, '0', STR_PAD_LEFT);
            $accountRef = "{$prefix}-{$suffix}";
        } while (self::where('account_ref', $accountRef)->exists());

        return $accountRef;
    }

    /**
     * Get all of the team's aws accounts.
     */
    public function awsAccounts(): HasMany
    {
        return $this->hasMany(AwsAccount::class);
    }
}
