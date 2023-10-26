<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="css/customCode.css" rel="stylesheet" type="text/css" >
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="w-full">
@include('templates/header')
<livewire:profile/>
@include('templates/footer')
</body>
</html>
