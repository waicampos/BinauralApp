<script src="https://accounts.google.com/gsi/client" async defer></script>

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{$message}}</li>
            @endforeach
        </ul>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="">
            <label for="email" class="form-label">{{ __('Email') }}:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2 invalid-feedback" />
            <div class="invalid-feedback">Informe um email válido</div>
        </div>

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

        <!-- Remember Me -->
        <div class="">
            <input id="remember" type="checkbox" class="form-check-input" name="remember" id="remember">
            <label for="remember" class="form-label">{{ __('Lembrar') }}</label>
        </div>

        <div class="">
                <a class="" href="{{ route('register') }}">
                    {{ __('Registrar nova conta') }}
                </a>            
        </div>

        <div class="">
            @if (Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
            @endif            
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>

    </form>


</x-guest-layout>
