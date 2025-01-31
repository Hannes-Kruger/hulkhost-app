<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-zinc-800">
    <div>
        {{ $logo }}
    </div>

    <flux:card class="space-y-6 w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden">
        {{ $slot }}
    </flux:card>
</div>
