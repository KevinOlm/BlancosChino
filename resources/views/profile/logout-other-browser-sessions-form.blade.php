<x-jet-action-section>
    <x-slot name="title">
        Sesiones de navegador
    </x-slot>

    <x-slot name="description">
        Maneja y cierra sesión de tus sesiones activas en otros navegadores y dispositivos
    </x-slot>

    <x-slot name="content">
        <div class="description">
            Si es necesario, puedes cerrar la sesión de todas las demás sesiones de tu navegador en todos tus dispositivos. Algunas de tus sesiones recientes se enumeran a continuación; sin embargo, esta lista puede no ser exhaustiva. Si crees que tu cuenta se ha visto comprometida, también debes actualizar tu contraseña.
        </div>

        @if (count($this->sessions) > 0)
            <div class="sessionContainer">
                <!-- Other Browser Sessions -->
                @foreach ($this->sessions as $session)
                    <div class="session">
                        <div>
                            @if ($session->agent->isDesktop())
                                <div class="sessionIcon">
                                    <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @else
                                <div class="sessionIcon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div>
                            <div class="description">
                                {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                            </div>

                            <div>
                                <div class="description">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="description">Este dispositivo</span>
                                    @else
                                        Última vez activo: {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center mt-5">

            <button
                class="registerButton"
                type="submit"
                wire:loading.attr="disabled"
                wire:click="confirmLogout">
                Cerrar sesión en otras cuentas
            </button>

            <x-jet-action-message on="loggedOut">
                Listo
            </x-jet-action-message>
        </div>

        <!-- Log Out Other Devices Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingLogout">
            <x-slot name="title">
                Cerrar sesión en otros dispositivos
            </x-slot>

            <x-slot name="content">
                <p class="description">Ingresa tu contraseña para confirmar que deseas cerrar la sesión de tus otras sesiones de navegador en todos tus dispositivos.</p>

                <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <input type="password" class="loginInput"
                                placeholder="Contraseña"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-jet-input-error for="password" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <button 
                    class="cancelButton"
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:click="$toggle('confirmingLogout')">
                    Cancelar
                </button>

                <button 
                    class="registerButton"
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:click="logoutOtherBrowserSessions">
                    Cerrar sesión en otros dispositivos
                </button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
