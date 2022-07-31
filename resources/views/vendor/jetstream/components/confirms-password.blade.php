@props(['title' => __('Confirma tu contraseña'), 'content' => __('Por tu seguridad, por favor, confirma tu contraseña para continuar'), 'button' => __('Confirmar')])

@php
    $confirmableId = md5($attributes->wire('then'));
@endphp

<span
    {{ $attributes->wire('then') }}
    x-data
    x-ref="span"
    x-on:click="$wire.startConfirmingPassword('{{ $confirmableId }}')"
    x-on:password-confirmed.window="setTimeout(() => $event.detail.id === '{{ $confirmableId }}' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);"
    class="TFButtonContainer"
>
    {{ $slot }}
</span>

@once
<x-jet-dialog-modal wire:model="confirmingPassword">
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <x-slot name="content">
        <p class="description">{{ $content }}</p>

        <div class="confirmPasswordInput" x-data="{}" x-on:confirming-password.window="setTimeout(() => $refs.confirmable_password.focus(), 250)">
            <input type="password" class="loginInput" placeholder="Contraseña"
                x-ref="confirmable_password"
                wire:model.defer="confirmablePassword"
                wire:keydown.enter="confirmPassword" />

            <x-jet-input-error for="confirmable_password" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <button 
            class="cancelButton"
            type="submit"
            wire:loading.attr="disabled"
            wire:click="stopConfirmingPassword">
            Cancelar
        </button>

        <button 
            class="registerButton"
            type="submit"
            wire:loading.attr="disabled"
            wire:click="confirmPassword">
            {{ $button }}
        </button>
    </x-slot>
</x-jet-dialog-modal>
@endonce
