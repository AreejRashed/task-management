@component('mail::message')
# Welcome, {{$user->name}}

Thanks for your registration,


@component('mail::panel')
To access your CMS panel, click on the button below
@component('mail::button', ['url' => '/cms/user/login', 'color' => 'success'])
Button Text
@endcomponent
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
