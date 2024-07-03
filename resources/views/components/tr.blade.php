@php
    $classes = 'border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-slate-700 group';
@endphp
<tr {{
    $attributes([
        'class' => "$classes"
        ])
    }}
>
    {{ $slot }}
</tr>
