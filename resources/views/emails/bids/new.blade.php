@component('mail::message')
# Nieuw bod geplaatst

Er is een nieuw bod ({{ number_format($bid->amount,2,'€','') }}) geplaatst op domein **{{ $domain->name }}**.

@component('mail::button', ['url' => $acceptUrl])
Bieding accepteren & betalen
@endcomponent

Groet,  
{{ config('app.name') }}
@endcomponent

