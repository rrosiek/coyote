@component('mail::message')
{{ $user->first_name }}

Your account has been confirmed and activated by a site administrator.

@component('mail::button', ['url' => route('login')])
Login
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent