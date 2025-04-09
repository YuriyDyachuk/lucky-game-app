<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                body {
                    background-color: #FDFDFC;
                    color: #1b1b18;
                    display: flex;
                    padding: 1.5rem;
                    align-items: center;
                    justify-content: center;
                    min-height: 100vh;
                    flex-direction: column;
                }

                form {
                    display: flex;
                    flex-direction: column;
                    width: 100%;
                    max-width: 400px;
                    padding: 2rem;
                    border: 1px solid #e3e3e0;
                    border-radius: 0.5rem;
                    background-color: white;
                }

                label {
                    margin-bottom: 0.5rem;
                    color: #706f6c;
                }

                input[type="text"] {
                    padding: 0.75rem;
                    margin-bottom: 1rem;
                    border: 1px solid #e3e3e0;
                    border-radius: 0.375rem;
                    font-size: 1rem;
                    color: #1b1b18;
                }

                button {
                    padding: 0.75rem 1.5rem;
                    background-color: #f53003;
                    color: white;
                    border: none;
                    border-radius: 0.375rem;
                    cursor: pointer;
                    font-size: 1rem;
                    transition: background-color 0.3s ease;
                }

                button:hover {
                    background-color: #d32f2f;
                }
            </style>
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                <form method="POST" action="{{ route('register.store') }}" class="flex flex-col align-center">
                    @csrf
                    <label for="name">Имя пользователя:</label>
                    <input type="text" name="name" id="name" required/>
                    <label for="phone_number">Номер телефона:</label>
                    <input type="text" name="phone_number" id="phone_number" required/>
                    <button type="submit">Зарегистрироваться</button>
                </form>
            </main>
        </div>
    </body>
</html>
