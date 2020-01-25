@component('mail::message')
# One more step to join us!

Hey {{$username}} , elearn needs to confirm your email.

@component('mail::button', ['url' => route('confirm_email') . '?token=' . $user->confirm_token])
Confirm email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
