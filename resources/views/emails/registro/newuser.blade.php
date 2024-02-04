<x-mail::message>
# Bienvenido.

Para el uso del sistema debera resetear la contraseña.

<x-mail::button :url="''">
Resetear contraseña
</x-mail::button>

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
