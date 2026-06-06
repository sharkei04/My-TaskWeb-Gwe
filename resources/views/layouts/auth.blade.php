<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskora</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen bg-gray-100 flex flex-col">

    <main class="flex-1 flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <footer class="flex h-[7vh] items-center justify-center border-t border-black bg-white text-[1.7vh] font-semibold tracking-wide text-gray-500">
        © 2026 Taskora. All rights reserved.
    </footer>

</body>
</html>