@component('mail::message')
# Invitation Accepted

Hello {{ $username }},

Great news! The invitation sent to {{ $name }} ({{ $email }}) has been accepted.

Thank you for using {{ config('app.name') }}!

Best regards,
{{ config('app.name') }} Team
@endcomponent