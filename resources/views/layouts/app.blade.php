<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title', 'To-Do List App')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])


    </head>

    <body class="bg-[#1A2A4F] text-[#FFF2EF] min-h-screen font-sans">

        <nav class="bg-[#1A2A4F] border-b border-[#FFDBB6] shadow-md">
            <div class="max-w-5xl mx-auto px-4 py-4 flex justify-between items-center">
                <a href="{{ route('tasks.index') }}"
                    class="text-[#FFDBB6] font-semibold text-xl hover:text-[#F7A5A5] transition">
                    To-Do List
                </a>
            </div>
        </nav>

        <main class="max-w-5xl mx-auto px-4 py-6">
            @yield('content')
        </main>

    </body>

</html>
