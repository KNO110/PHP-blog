@props([
    'type' => 'info', // Тип за замовчуванням
])

@php
    $classes = [
        'info' => 'is-info',
        'success' => 'is-success',
        'warning' => 'is-warning',
        'danger' => 'is-danger',
    ];

    $alertClass = $classes[$type] ?? 'is-info';
@endphp

<div {{ $attributes->merge(['class' => "notification {$alertClass}"]) }}>
    @if($attributes->has('dismissible') || $attributes->get('dismissible', true))
        <button class="delete" onclick="this.parentElement.remove()"></button>
    @endif
    {{ $slot }}
</div>
