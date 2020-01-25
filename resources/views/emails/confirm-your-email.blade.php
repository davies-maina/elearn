@component('mail::message')
# One more step to join us!

elearn needs to confirm your email.

@component('mail::button', ['url' => ''])
Confirm email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
