<x-guest-layout>
    <div class="pt-4 bg-gray-100 dark:bg-zinc-800">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-authentication-card-logo />
            </div>
            <flux:card class="w-full sm:max-w-2xl mt-6 p-6 overflow-hidden prose dark:prose-invert">
                {!! $policy !!}
            </flux:card>
        </div>
    </div>
</x-guest-layout>
