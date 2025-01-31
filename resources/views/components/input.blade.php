@props(['disabled' => false])

<flux:input {{ $attributes->merge(['type' => 'text', 'disabled' => $disabled]) }} />
