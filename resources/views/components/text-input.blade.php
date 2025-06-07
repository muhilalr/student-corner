@props(['disabled' => false])

<input @disabled($disabled)
  {{ $attributes->merge(['class' => 'border-primary focus:border-primary focus:ring-primary rounded-md shadow-sm']) }}>
