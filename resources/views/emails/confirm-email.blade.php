@component('mail::message')
# One Last Step

Please confirm your email address

@component('mail::button', ['url' => url('/register/confirm?token=' . $user->confirmation_token)])
    Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
