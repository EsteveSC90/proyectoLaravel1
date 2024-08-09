@extends('template')

@section('title', "Inicio")

<style>
            /*!*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css *!*/
            html {
                line-height: 1.15;
                -webkit-text-size-adjust: 100%
            }

            body {
                margin: 0
            }

            a {
                background-color: transparent
            }

            [hidden] {
                display: none
            }

            html {
                font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
                line-height: 1.5
            }

            *, :after, :before {
                box-sizing: border-box;
                border: 0 solid #e2e8f0
            }

            a {
                color: inherit;
                text-decoration: inherit
            }

            svg, video {
                display: block;
                vertical-align: middle
            }

            video {
                max-width: 100%;
                height: auto
            }

            .bg-white {
                --tw-bg-opacity: 1;
                background-color: rgb(255 255 255 / var(--tw-bg-opacity))
            }

            .bg-gray-100 {
                --tw-bg-opacity: 1;
                background-color: rgb(243 244 246 / var(--tw-bg-opacity))
            }

            .border-gray-200 {
                --tw-border-opacity: 1;
                border-color: rgb(229 231 235 / var(--tw-border-opacity))
            }

            .border-t {
                border-top-width: 1px
            }

            .flex {
                display: flex
            }

            .grid {
                display: grid
            }

            .hidden {
                display: none
            }

            .items-center {
                align-items: center
            }

            .justify-center {
                justify-content: center
            }

            .font-semibold {
                font-weight: 600
            }

            .h-5 {
                height: 1.25rem
            }

            .h-8 {
                height: 2rem
            }

            .h-16 {
                height: 4rem
            }

            .text-sm {
                font-size: .875rem
            }

            .text-lg {
                font-size: 1.125rem
            }

            .leading-7 {
                line-height: 1.75rem
            }

            .mx-auto {
                margin-left: auto;
                margin-right: auto
            }

            .ml-1 {
                margin-left: .25rem
            }

            .mt-2 {
                margin-top: .5rem
            }

            .mr-2 {
                margin-right: .5rem
            }

            .ml-2 {
                margin-left: .5rem
            }

            .mt-4 {
                margin-top: 1rem
            }

            .ml-4 {
                margin-left: 1rem
            }

            .mt-8 {
                margin-top: 2rem
            }

            .ml-12 {
                margin-left: 3rem
            }

            .-mt-px {
                margin-top: -1px
            }

            .max-w-6xl {
                max-width: 72rem
            }

            .min-h-screen {
                min-height: 100vh
            }

            .overflow-hidden {
                overflow: hidden
            }

            .p-6 {
                padding: 1.5rem
            }

            .py-4 {
                padding-top: 1rem;
                padding-bottom: 1rem
            }

            .px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .pt-8 {
                padding-top: 2rem
            }

            .fixed {
                position: fixed
            }

            .relative {
                position: relative
            }

            .top-0 {
                top: 0
            }

            .right-0 {
                right: 0
            }

            .shadow {
                --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / .1), 0 1px 2px -1px rgb(0 0 0 / .1);
                --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
            }

            .text-center {
                text-align: center
            }

            .text-gray-200 {
                --tw-text-opacity: 1;
                color: rgb(229 231 235 / var(--tw-text-opacity))
            }

            .text-gray-300 {
                --tw-text-opacity: 1;
                color: rgb(209 213 219 / var(--tw-text-opacity))
            }

            .text-gray-400 {
                --tw-text-opacity: 1;
                color: rgb(156 163 175 / var(--tw-text-opacity))
            }

            .text-gray-500 {
                --tw-text-opacity: 1;
                color: rgb(107 114 128 / var(--tw-text-opacity))
            }

            .text-gray-600 {
                --tw-text-opacity: 1;
                color: rgb(75 85 99 / var(--tw-text-opacity))
            }

            .text-gray-700 {
                --tw-text-opacity: 1;
                color: rgb(55 65 81 / var(--tw-text-opacity))
            }

            .text-gray-900 {
                --tw-text-opacity: 1;
                color: rgb(17 24 39 / var(--tw-text-opacity))
            }

            .underline {
                text-decoration: underline
            }

            .antialiased {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale
            }

            .w-5 {
                width: 1.25rem
            }

            .w-8 {
                width: 2rem
            }

            .w-auto {
                width: auto
            }

            .grid-cols-1 {
                grid-template-columns:repeat(1, minmax(0, 1fr))
            }

            @media (min-width: 640px) {
                .sm\:rounded-lg {
                    border-radius: .5rem
                }

                .sm\:block {
                    display: block
                }

                .sm\:items-center {
                    align-items: center
                }

                .sm\:justify-start {
                    justify-content: flex-start
                }

                .sm\:justify-between {
                    justify-content: space-between
                }

                .sm\:h-20 {
                    height: 5rem
                }

                .sm\:ml-0 {
                    margin-left: 0
                }

                .sm\:px-6 {
                    padding-left: 1.5rem;
                    padding-right: 1.5rem
                }

                .sm\:pt-0 {
                    padding-top: 0
                }

                .sm\:text-left {
                    text-align: left
                }

                .sm\:text-right {
                    text-align: right
                }
            }

            @media (min-width: 768px) {
                .md\:border-t-0 {
                    border-top-width: 0
                }

                .md\:border-l {
                    border-left-width: 1px
                }

                .md\:grid-cols-2 {
                    grid-template-columns:repeat(2, minmax(0, 1fr))
                }
            }

            @media (min-width: 1024px) {
                .lg\:px-8 {
                    padding-left: 2rem;
                    padding-right: 2rem
                }
            }

            @media (prefers-color-scheme: dark) {
                .dark\:bg-gray-800 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(31 41 55 / var(--tw-bg-opacity))
                }

                .dark\:bg-gray-900 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(17 24 39 / var(--tw-bg-opacity))
                }

                .dark\:border-gray-700 {
                    --tw-border-opacity: 1;
                    border-color: rgb(55 65 81 / var(--tw-border-opacity))
                }

                .dark\:text-white {
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity))
                }

                .dark\:text-gray-400 {
                    --tw-text-opacity: 1;
                    color: rgb(156 163 175 / var(--tw-text-opacity))
                }

                .dark\:text-gray-500 {
                    --tw-text-opacity: 1;
                    color: rgb(107 114 128 / var(--tw-text-opacity))
                }
            }

            /*.scroll-to-top {*/
            /*    border-radius: 50%;*/
            /*    background-color: #2563eb; !* bg-blue-600 *!*/
            /*    color: #ffffff; !* text-white *!*/
            /*    padding: 0.5rem; !* p-2 *!*/
            /*    transition: background-color 0.3s;*/
            /*}*/

            /*.scroll-to-top:hover {*/
            /*    background-color: #1e40af; !* hover:bg-blue-800 *!*/
            /*}*/

            .flex.items-center > div {
                margin-left: 1rem; !* Tailwind's ml-4 *!
            }

            .flex.items-center > div:first-child {
                margin-left: 0;
            }

            body {
                font-family: 'Nunito', sans-serif;
            }

            .sm\:justify-start {
                justify-content: center !important;
            }

            .color_title {
                color: rgb(162, 26, 26);
            }

            .footer {
                background: #0c0c0c;
                color: white;
                height: 50px;
            }
        </style>
@section('css')

@endsection

@section('content')

        <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
            <?php
            // Utiliza la función route() para obtener la URL asociada a la ruta
            //$routeUrl = route('welcome.index');

            // Utiliza la función dd() para imprimir la URL asociada a la ruta y detener la ejecución
            //dd($routeUrl);
            ?>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <h1 class="color_title"><i class="fas fa-car"></i> ELITE MOTORS - CONCESIONARIO <i class="fas fa-car"></i></h1>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-6 flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <a href="{{ route('vehicles.list') }}" class="text-blue-600 hover:text-blue-800 btn btn-primary" type="button"><i class="fas fa-car dark:text-white-500 w-8 h-8"></i> Vehículos</a>
                            </div>
                            <div class="ml-4 text-gray-600 dark:text-gray-400 text-sm">
                                Lista de vehículos
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <a href="{{ route('clients.list') }}" class="text-blue-600 hover:text-blue-800 btn btn-primary" type="button"><i class="fas fa-users dark:text-white-500 w-8 h-8"></i> Clientes</a>
                            </div>
                            <div class="ml-4 text-gray-600 dark:text-gray-400 text-sm">
                                Lista de clientes
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <a href="{{ route('sellers.list') }}" class="text-blue-600 hover:text-blue-800 btn btn-primary" type="button"><i class="fas fa-user-tie dark:text-white-500 w-8 h-8"></i> Vendedores</a>
                            </div>
                            <div class="ml-4 text-gray-600 dark:text-gray-400 text-sm">
                                Lista de vendedores
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <a href="{{ route('sells.list') }}" class="text-blue-600 hover:text-blue-800 btn btn-primary" type="button"><i class="fas fa-shopping-cart dark:text-white-500 w-8 h-8"></i> Ventas</a>
                            </div>
                            <div class="ml-4 text-gray-600 dark:text-gray-400 text-sm">
                                Lista de ventas
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            CAR DEALER PROJECT
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>

            {{--            copyright--}}
            </div>

@endsection

@section('js')
    <script href=""></script>
@endsection
