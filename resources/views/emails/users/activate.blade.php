@component('mail::message')
The following user has registered on the site.

**Name:** {{ $user->name }}<br>
**Email:** {{ $user->email }}<br>
**Graduation Year:** {{ $user->grad_year }}

@component('mail::button', ['url' => route('register.activate', ['token' => $user->activate_token])])
Approve User
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent