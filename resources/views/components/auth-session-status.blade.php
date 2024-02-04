@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 dark:text-green-400']) }}>
        {{ $status }} <a href="/" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><u>Ir a
                Inicio</u></a>

    </div>
@endif
