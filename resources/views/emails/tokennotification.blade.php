@component('mail::message')

Hello {{ ucwords($user->firstname)}}!

<p class="mail-body-text">
Token No: {{ $token->token }} <br />
Department: {{ $token->department }}, Counter: {{ $token->counter }} and Officer: {{ $token->officer }}. <br />
Your waiting no is {{ $token->token }}.<br />
{{ $token->date }}.
</p>

@slot('subcopy')
@component('mail::subcopy')
<p>
Cheers,<br>
The Support team
</p>
@endcomponent
@endslot


@endcomponent