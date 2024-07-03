<td
    {{
        $attributes->merge([
            'class' => 'px-6 py-4 border-b text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 group-hover:text-gray-800
            group-hover:dark:text-white group-hover:scale-110 transition-all duration-300'
        ])
    }}>
    {{ $slot }}
</td>
