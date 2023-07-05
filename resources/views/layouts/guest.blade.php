<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- CSS Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>

            /* Hide all steps by default: */
            .tab {
            display: none;
            }

            /* Make circles that indicate the steps of the form: */
            /* Pode mudar por qualquer outro ícone ou svg */
            .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 1;
            }

            /* Mark the active step: */
            .step.active {
            background-color: var(--primary);
            opacity: 1;
            }

            /* Mark the steps that are finished and valid: */
            .step.finish {
            background-color: var(--primary);
            opacity: 0.8;
            }

            .step.active.finish {
            opacity: 1;
            }

            .criterio-atendido {
                color: var(--success);
            }
    </style>
    </head>
    <body>
        <div class="container">
            <div>
                <a href="/">
                    <x-application-logo class="" />
                </a>
            </div>

            <div>
                {{ $slot }}
            </div>
        </div>

    </body>
</html>
