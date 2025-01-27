<!DOCTYPE html>
<html lang="en" data-theme="emerald">

<head>
    @include('components.head')
    <style>
        .toast {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .toast-show {
            opacity: 1;
        }
    </style>

</head>

<body class="flex flex-col mx-auto min-h-screen">
    <div id="splash-screen"
        class="fixed inset-0 flex items-center justify-center bg-white min-h-screen z-[9999] transition-opacity duration-500 ease-in-out opacity-100">
        <div class="relative flex flex-col items-center justify-center p-8 bg-white rounded-lg shadow-lg">
            <div class="w-16 h-16 mb-4 border-t-4 border-[#222939] rounded-full animate-spin"></div>
            <div>
                @include('components.brands')
            </div>
        </div>
    </div>

    @if (!str_contains(request()->path(), 'dashboard') && !request()->is('login') && !request()->is('register'))
        @include('components.navbar')
    @endif

    <main class="{{ $class ?? 'p-4' }}" role="main">

        {{ $slot }}
        <div id="toast-container" class="fixed top-5 right-5 z-50 space-y-4"></div>

        <script>
            function showToast(message, type) {
                const toastContainer = document.getElementById('toast-container');
                const toast = document.createElement('div');

                toast.classList.add(
                    'relative', 'shadow-lg', 'bg-white', 'p-4', 'rounded-lg', 'flex',
                    'items-center', 'justify-between', 'border-l-4', `border-${type}`,
                    'transition-transform', 'transition-opacity', 'transform', 'duration-300', 'ease-in-out',
                    'opacity-0', 'translate-x-full'
                );

                toast.innerHTML = `
            <div class="flex-grow flex items-center space-x-2">
                <span class="font-semibold">${message}</span>
            </div>
            <button class="ml-4 btn btn-sm btn-circle btn-ghost" onclick="this.parentElement.remove()">✕</button>
        `;

                toastContainer.appendChild(toast);

                setTimeout(() => {
                    toast.classList.remove('translate-x-full', 'opacity-0');
                    toast.classList.add('translate-x-0', 'opacity-100');
                }, 100);

                setTimeout(() => {
                    toast.classList.remove('translate-x-0', 'opacity-100');
                    toast.classList.add('translate-x-full', 'opacity-0');
                    setTimeout(() => {
                        toast.remove();
                    }, 300);
                }, 15000);
            }

            @if (session('toast'))
                showToast('{{ session('toast.message') }}', '{{ session('toast.type') }}');
            @endif
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var splashScreen = document.getElementById('splash-screen');

                splashScreen.classList.add('show');

                window.addEventListener('load', function() {
                    splashScreen.classList.remove('show');
                });
            });

            window.addEventListener('beforeunload', function() {
                var splashScreen = document.getElementById('splash-screen');
                splashScreen.classList.add('show');
            });
        </script>
        @if (!str_contains(request()->path(), 'dashboard') && !request()->is('login') && !request()->is('register'))
            @include('components.footer')
        @endif
    </main>
</body>

</html>
