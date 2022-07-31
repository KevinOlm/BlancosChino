@props(['submit'])

<div {{ $attributes->merge(['class' => 'formSection']) }}>
    <x-jet-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-jet-section-title>

    <div class="formContainer">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="formContent">
                {{ $form }}
            </div>

            @if (isset($actions))
                <div class="actionsContent">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
