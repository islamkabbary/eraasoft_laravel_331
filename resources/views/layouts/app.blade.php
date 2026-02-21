<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon Clone - @yield("title")</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack("style")
</head>
<body>
    @include("partials.nav")

    @yield("content")

    <footer class="text-center py-4">
        <div class="mb-2">
            <a href="#" class="mx-2">Conditions of Use</a>
            <a href="#" class="mx-2">Privacy Notice</a>
            <a href="#" class="mx-2">Help</a>
        </div>
        <p>&copy; 1996-2026, Amazon.com, Inc. or its affiliates</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>