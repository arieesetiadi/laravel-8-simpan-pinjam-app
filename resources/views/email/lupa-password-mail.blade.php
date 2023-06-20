@component('mail::message')
# Pengaturan Ulang Password
 
Tekan link dibawah untuk melanjutkan proses pengaturan ulang password.
 
@component('mail::button', ['url' => $url])
Link
@endcomponent
 
Terimakasih,<br>
{{ config('app.name') }}
@endcomponent