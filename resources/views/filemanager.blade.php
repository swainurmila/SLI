<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manager</title>
    {{-- <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}"> --}}


    <!-- Filemanager css -->
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <!-- End Filemanager css -->
</head>
<body>
    <div id="fm" ></div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fm = document.getElementById('fm');
            fm.style.height = '100%'; // Adjust height to take full container height
        });
    </script>
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
</body>
</html>
