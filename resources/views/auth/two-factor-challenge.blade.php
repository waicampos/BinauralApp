<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div x-data="{ recovery: false }">
            <div class="" x-show="! recovery">
                {{ __('Por favor, confirme o acesso a sua conta informando o código de autenticação gerado pela sua aplicação.') }}
            </div>

            <div class="" x-cloak x-show="recovery">
                {{ __('Por favor, confime acesso a sua conta informando um de seus códigos de recuperação de emergência.') }}
            </div>

            <x-validation-errors class="" />

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="" x-show="! recovery">
                    <label for="code" class="form-label">{{ __('Code') }}</label>
                    <input type="text" name="code" id="code" class="form-control" inputmode="numeric" x-ref="code" autocomplete="one-time-code">
                </div>

                <div class="" x-cloak x-show="recovery">
                    <label for="recovery_code" class="form-label">{{ __('Recovery Code') }}</label>
                    <input type="text" name="recovery_code" id="recovery-code" class="form-control" x-ref="recovery_code" autocomplete="one-time-code">
                </div>

                <div class="">
                    <button type="button" class=""
                                    x-show="! recovery"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('Usar um código de recuperação') }}
                    </button>

                    <button type="button" class=""
                                    x-cloak
                                    x-show="recovery"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('Usar um código de autenticação') }}
                    </button>


                    <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>

                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
