<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="css/customCode.css" rel="stylesheet" type="text/css" >
    <title>Resselr</title>
</head>
<body class="w-full antialiased">
    @include('templates/header')
    <livewire:search-bar/>
    @include('templates/footer')
</body>
</html>
<script>
    function toggleFilterModal() {
        const place = document.querySelector("#FilterModal");

        if (place.classList.contains("hidden")) {
            place.classList.remove("hidden");
        } else {
            place.classList.add("hidden");
        }
    }
</script>
