@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <flux:heading size="lg">{{ $title }}</flux:heading>

        <flux:subheading>{{ $content }}</flux:subheading>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 text-end">
        {{ $footer }}
    </div>
</x-modal>
