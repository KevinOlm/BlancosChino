@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'errorMessage']) }}>{{ $message }}</p>
@enderror