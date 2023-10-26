<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="../css/customCode.css" rel="stylesheet" type="text/css" >
</head>
<body class="w-full Custom-TextFont1">
    @include('templates/header')
    <div x-data="{ CurrentPhoto: 0 }" class="pb-3 pt-3 bg-gray-100 flex items-center flex-col">
        <div class="w-11/12 sm:w-8/12 md:w-6/12 flex justify-center flex-col items-center">
            @foreach($item->images as $index => $image)
                <div x-show="CurrentPhoto === {{$index}}" class="relative bg-white sm:w-8/12 h-[450px] flex justify-center">
                    <img class="w-full object-cover" src="{{ asset($image->ImageURL) }}">
                    <div class="absolute top-1/2 left-0 w-full flex justify-between">
                        <i @click="CurrentPhoto = (CurrentPhoto > 0) ? (CurrentPhoto - 1) : 0;" class='cursor-pointer bg-white bg-opacity-70 font-bold text-4xl bx bxs-chevron-left'></i>
                        <i @click="CurrentPhoto = (CurrentPhoto < {{ count($item->images) - 1 }}) ? (CurrentPhoto + 1) : {{ count($item->images) - 1 }};" class='cursor-pointer bg-white bg-opacity-70 font-bold text-4xl bx bxs-chevron-right'></i>
                    </div>
                </div>
            @endforeach
                <div class="flex justify-center mt-4 mb-2">
                    <template x-for="(image, index) in {{$item->images}}" :key="index">
                        <template x-if="index !== CurrentPhoto">
                            <img @click="CurrentPhoto = index;" class="w-24 h-24 md:w-36 md:h-36 object-cover cursor-pointer" :src="startLine+image.ImageURL+endLine">
                        </template>
                    </template>
                </div>
        </div>
        <div class="w-full sm:w-8/12 md:w-6/12">
            <div class="w-full text-left">
                <div class="font-bold text-gray-700 pl-3 text-3xl">{{$item->ItemName}}</div>
            </div>
            <div class="w-full">
                <div class="pl-3 text-left">{{$item->Category->CategoryName}}</div>
            </div>
            <div class="w-full text-right">
                <div class="font-bold text-2xl pr-2">{{$item->Price}} €</div>
            </div>
            <div class="w-full text-left">
                <div class="text-md text-gray-600 pl-3 pr-3 pb-3">{{$item->Description}}</div>
            </div>
            <div class="w-full flex justify-end">
                <div class="cursor-pointer bg-blue-600 text-white rounded-md px-3 py-2 w-fit mr-3">Buy now</div>
            </div>
            <div class="w-full pl-3 ">
                <div class="flex w-fit px-2 border-2 border-white border-opacity-100 rounded-lg">
                    <div class="w-fit justify-center flex items-center pr-2">
                        <i class='bx bxs-user leading-'></i>
                    </div>
                    <span class="animate-pulse bg-gradient-to-r from-pink-500 via-green-500 to-violet-500 bg-clip-text text-transparent">{{$item->Seller->Email}}</span>
                </div>
            </div>
        </div>
        </div>
    @include('templates/footer')
</body>
<script>
    const startLine = `{{ asset('`;
    const endLine = `') }}`;
</script>
</html>
