@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'is-invalid']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
