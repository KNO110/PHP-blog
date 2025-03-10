@component('mail::message')
# Повідомлення від Laravel

{{ $text }}

@component('mail::button', ['url' => url('/')])
Перейти на сайт
@endcomponent

Дякуємо, що користуєтесь нашим сервісом!
{{ config('app.name') }}
@endcomponent
