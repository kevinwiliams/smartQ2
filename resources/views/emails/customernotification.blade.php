@component('mail::message')

Hello {{ ucwords($name)}}!

<p class="mail-body-text">
{{ $message }}
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