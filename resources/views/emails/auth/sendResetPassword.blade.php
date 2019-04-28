@component('mail::message')
Hello {{ $user->first_name . ' ' . $user->last_name }},

You can reset your password by clicking the button.
<br>
@component('mail::button', ['url' => route('reset.password.form', ['token' => $passwordReset->token])])
Reset password
@endcomponent
<br>
{{ route('reset.password.form', ['token' => $passwordReset->token]) }}
<br>
<br>
You can copy-paste the code above into your browser if the link won't work.
<br>

Cheers,<br>
The {{ config('app.name') }} team
@endcomponent
