@props([
    'disabled' => false,
    'name' => null,
    'value' => null,
    'placeholder' => '0.00',
    'min' => null,
    'max' => null,
    'step' => '0.01',
    'required' => false,
    'center' => false, // Center the text
    'nameExpression' => null,
])

<input type="number" autocomplete="off"
    @if ($nameExpression) x-bind:name="{{ $nameExpression }}" @else name="{{ $name }}" @endif
    value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}"
    @if ($min !== null) min="{{ $min }}" @endif
    @if ($max !== null) max="{{ $max }}" @endif step="{{ $step }}"
    @disabled($disabled) {{ $required ? 'required' : '' }}
    {{ $attributes->merge([
        'class' =>
            'text-sm bg-white border border-gray-900 dark:bg-gray-900 text-black dark:text-white outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900 
                               [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none
                               ' . ($center ? 'text-center ' : ''),
    ]) }}>
