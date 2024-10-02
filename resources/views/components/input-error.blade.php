@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'text-danger']) }}>
        @foreach ((array) $messages as $message)
            <span>{{ $message }}</span>
        @endforeach
    </div>
@endif
