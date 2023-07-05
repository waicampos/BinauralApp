<x-guest-layout>
    <div class="">
        {{ __('Esqueceu sua senha? Sem problemas. Apenas nos informe seu endereço de email e nós iremos lhe enviar um link para resetar sua senha.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="">
            <label for="email" class="form-label">{{ __('Email') }}:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2 invalid-feedback" />
            <div class="invalid-feedback">Informe um email válido</div>
        </div>

        <div class="">
            <button type="submit" class="btn btn-primary">{{ __('Enviar o link para resetar a senha por email') }}</button>
        </div>
    </form>
</x-guest-layout>
