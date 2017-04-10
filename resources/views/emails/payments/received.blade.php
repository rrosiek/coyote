@component('mail::message')
A new payment has been completed on the website:

**Name:** {{ $payment->name }}<br>
**Email:** {{ $payment->email }}<br>
**For:** {{ $payment->product }}<br>
**Amount:** ${{ number_format(($payment->amount / 100), 2, '.', '') }}

Thank you,<br>
{{ config('app.name') }}
@endcomponent