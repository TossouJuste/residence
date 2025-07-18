@component('mail::message')
# Code de vérification

Votre code de vérification est : **{{ $code }}**

Merci,<br>
{{ config('app.name') }}
@endcomponent
