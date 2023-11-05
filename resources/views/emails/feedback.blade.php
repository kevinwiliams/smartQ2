@component('mail::message')
# New Feedback Submitted

**User:** {{ $feedback['name'] }}

**Email:** {{ $feedback['email'] }}

**Comment:** {{ $feedback['comment'] }}

**Type:** {{ $feedback['type'] }}

**Referer:** {{ $feedback['referer'] }}

**Created At:** {{ $feedback['created_at'] }}

**User Agent:** {{ $feedback['user_agent'] }}

**IP Address:** {{ $feedback['ip_address'] }}

**OS Version:** {{ $feedback['os_version'] }}

**Browser Version:** {{ $feedback['browser_version'] }}

**Rating:** {{ $feedback['rating'] ?? 'N/A' }}

**Source:** {{ $feedback['source'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent