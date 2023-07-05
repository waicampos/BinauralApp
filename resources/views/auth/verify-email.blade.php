<x-guest-layout>
    <div class="">
        {{ __('Obrigada por se registrar! Antes de começar, verifique se você recebeu o link de verificação de e-mail? Se você não recebeu, solicite o envio de outro email.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="">
            {{ __('Um novo link de verificação foi enviado ao endereço de email que você informou no seu cadastro.') }}
        </div>
    @endif

    <div class="">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <button type="submit" class="btn btn-primary">{{ __('Reenviar Email de Verificação') }}</button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-primary">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
