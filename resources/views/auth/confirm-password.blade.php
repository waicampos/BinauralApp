<x-guest-layout>
    <div class="">
        {{ __('Esta é uma área protegida. Por favor, confirme sua senha antes de prosseguir.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <div class="">
                <label for="password" class="form-label">{{ __('Senha') }}: </label>
                <input type="password" name="password" id="password" class="form-control" required autocomplete="current-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <div class="invalid-feedback">Informe sua senha segura</div>
            </div>
            <div class="fs-4 col-1">
                <i id="see_password" class="bi bi-eye-slash"></i>
            </div>
        </div>

        <div class="">
            <button type="submit" class="btn btn-primary">{{ __('Confirmar') }}</button>
        </div>
    </form>

</x-guest-layout>
