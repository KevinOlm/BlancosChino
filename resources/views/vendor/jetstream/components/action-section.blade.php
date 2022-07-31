<div class="formSection" {{ $attributes }}>
    <x-jet-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-jet-section-title>

    <div class="formContainer">
        <div class="formContent">
            {{ $content }}
        </div>
    </div>
</div>
