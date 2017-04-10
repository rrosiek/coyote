@component('mail::message')
Thank you for your payment!  Below are the transaction details for your records:

**Name:** {{ $payment->name }}<br>
**Email:** {{ $payment->email }}<br>
**For:** {{ $payment->product }}<br>
**Amount:** ${{ number_format(($payment->amount / 100), 2, '.', '') }}

**Charged To:** {{ $payment->cc_brand }} **** {{ $payment->cc_lastfour}}

Thank you,<br>
{{ config('app.name') }}
@endcomponent