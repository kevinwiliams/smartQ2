@component('mail::message')
# Invitation to new staff

Hello {{ $invite->name }},

{{ $invite->user->name }} invited to join {{ config('app.name') }}. Please click the button below to accept the invitation:

@component('mail::button', ['url' => $url])
Accept Invitation
@endcomponent

If the button above does not work, you can also copy and paste the following link into your browser:

[{{ $url }}]({{ $url }})

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
