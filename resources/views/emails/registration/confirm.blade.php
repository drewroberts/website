@component('mail::message', ['user' => $user])
# Introduction

Thank you for subscribing to my weekly newsletter, {{ $user->name }}. 

Please confirm your email address by clicking the link below:

@component('mail::button', ['url' => 'https://drewroberts.com/newsletter/confirm/' . $user->id_token])
Confirm Email
@endcomponent

Thank you,<br>
Drew Roberts
@endcomponent
