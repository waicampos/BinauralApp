<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <div>
            <label for="email" class="form-label">Email: </label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Insira seu email" value="{{ old('email') }}" autocomplete="email" required>
            <x-input-error :messages="$errors->get('email')" class="mt-2 invalid-feedback" />
            <div class="error invalid-feedback">Informe um email válido</div>
        </div>

        <!-- Password -->
        <div class="row">
            <div class="col-11">
                <label for="password" class="form-label">Senha:</label>
                <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" placeholder="A senha deve ter no mínimo 8 caracteres, sendo 1 número, 1 letra maiúscula e 1 caractere especial" autocomplete="new-password" required>
                <x-input-error :messages="$errors->get('password')" class="mt-2 invalid-feedback" />
                <div class="error invalid-feedback">A senha deve possuir ao menos:<br>
                    <ul>
                        <li id="mixLength">8 caracteres</li>
                        <li id="hasDigit">1 número</li>
                        <li id="hasUpperCase">1 letra maiúscula</li>
                        <li id="hasSpecialChar">1 caractere especial como ! @ # $ % & *</li>
                    </ul>
                </div>
            </div>
            <div class="fs-4 col-1">
                <i id="see_password" class="bi bi-eye-slash"></i>
            </div>
        </div>

        <!-- Password Confirmation -->
        <div class="row">                
            <div class="col-11">
                <label for="password_confirmation" class="form-label">Confirmar senha:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" placeholder="Confirme sua senha" required>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 invalid-feedback" />
                <div class="error invalid-feedback">As senhas não estão iguais!</div>
            </div>
            <div class="col-1"> 
                <i id="see_password_confirm" class="bi bi-eye-slash"></i>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
