@component('mail::message')
# Introduction

Hello {{ ucwords($user->firstname)}}!

<p class="mail-body-text">
Welcome to {{ config('app.name') }}.
</p>
<p class="mail-body-text">
You're password is: <h1>{{ $password }}</h1>
</p>

@component('mail::button', ['url' => config('app.url') ])
Log In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
