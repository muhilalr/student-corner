@props(['status'])

@if ($status)
  <div
    {{ $attributes->merge(['class' => 'font-medium text-sm bg-green-600 border border-green-600 text-white px-4 py-3 rounded']) }}>
    {{ $status }}
  </div>
@endif
