@component('mail::message')
# Welcome to Adviceli

Thanks for signing up. We **really appreciate** it. Let us _know if we can_ do more to please You!

@component('mail::button', ['url' => 'http://localhost:8000/home'])
View My Panel
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
