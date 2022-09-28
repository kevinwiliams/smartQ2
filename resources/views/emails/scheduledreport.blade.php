@component('mail::message')

Hello!

<p class="mail-body-text">
<h1>{{ $mailmessage }}</h1>
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