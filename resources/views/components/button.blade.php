<!-- resources/views/components/Button.blade.php -->

@props(['variant' => 'default', 'size' => 'default', 'disabled' => false])

@php
$baseClasses = 'inline-flex items-center justify-center rounded-md font-bold transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 uppercase text-xs tracking-widest focus:outline-none transition ease-in-out duration-150';

$variantClasses = [
        'default' => 'bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800',
        'secondary' => 'bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-2',
        'outline' => 'border-gray-800 dark:border-gray-200 text-gray-800 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600 focus:bg-gray-200 dark:focus:bg-gray-600 active:bg-gray-300 dark:active:bg-gray-300 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800',
        'ghost' => 'bg-transparent text-gray-800 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600 focus:bg-gray-200 dark:focus:bg-gray-600 active:bg-gray-300 dark:active:bg-gray-300 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800',
        'destructive' => 'bg-red-600 text-white hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800',
        'link' => 'text-blue-500 hover:underline focus:underline active:text-blue-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800',
    ];


$sizeClasses = [
    'default' => 'h-10 px-4 py-2',
    'sm' => 'h-9 rounded-md px-3',
    'lg' => 'h-11 rounded-md px-8',
    'icon' => 'h-10 w-10',
];

$variantClass = isset($variantClasses[$variant]) ? $variantClasses[$variant] : $variantClasses['default'];
$sizeClass = isset($sizeClasses[$size]) ? $sizeClasses[$size] : $sizeClasses['default'];

$classes = "{$baseClasses} {$variantClass} {$sizeClass}";

if ($disabled) {
    $classes .= ' disabled:pointer-events-none disabled:opacity-50';
}
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
