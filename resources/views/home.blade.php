<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
    <link href="css/customCode.css" rel="stylesheet" type="text/css" >
</head>
<body class="w-full">
    @include('templates/header')
    <div class="pt-3 pb-3 h-auto flex justify-center items-center w-full flex-col bg-custom-background1">
        <div class="md:w-6/12 flex justify-center items-center flex-col">
            <div class="pb-3 font-sans text-5xl font-bold leading-[120%] Custom-TextFont1">
                We Bring<br><div class="text-custom-textcolor2">Customers</div>
            </div>
            <div class="sm:w-10/12 ml-3 mr-2 Custom-TextFont1 italic font-medium leading-[170%]">
                In the ever-evolving landscape of business, adaptability and innovation are paramount. We must embrace change and continuously seek new opportunities to grow and succeed.
            </div>
        </div>
    </div>
    <div>
        <div class="flex justify-center flex-col items-center pt-3 pb-3 h-auto">
            <div class="w-full">
                <div class="text-center font-semibold Custom-TextFont1 pb-3">The most recent items uploaded by <div class="inline-block text-custom-textcolor2">Users</div> in our marketplace.</div>
                <div class="w-full flex overflow-auto whitespace-nowrap custom-class-scroll h-auto sm:flex sm:justify-center" id="recentItemsContainer">
                </div>
            </div>
        </div>
    </div>

    <div class="bg-custom-background1 h-auto pb-5 sm:flex sm:justify-center">
        <div class="sm:w-3/4 md:w-6/12">
            <div class="pt-3  pb-3 pl-3 text-2xl font-bold Custom-TextFont1 flex">
                <svg class="inline-block w-[2rem]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(16, 123, 16, 1);transform: ;msFilter:;"><path d="M15.999 8.5h2c0-2.837-2.755-4.131-5-4.429V2h-2v2.071c-2.245.298-5 1.592-5 4.429 0 2.706 2.666 4.113 5 4.43v4.97c-1.448-.251-3-1.024-3-2.4h-2c0 2.589 2.425 4.119 5 4.436V22h2v-2.07c2.245-.298 5-1.593 5-4.43s-2.755-4.131-5-4.429V6.1c1.33.239 3 .941 3 2.4zm-8 0c0-1.459 1.67-2.161 3-2.4v4.799c-1.371-.253-3-1.002-3-2.399zm8 7c0 1.459-1.67 2.161-3 2.4v-4.8c1.33.239 3 .941 3 2.4z"></path></>
                <div class="flex items-center justify-center leading-5">Reselling Made Easy</div>
            </div>
            <div class="pl-3 pr-3 text-sm">
                Are you looking for a lucrative opportunity to boost your income? Welcome to our reselling platform, where turning a profit has never been more straightforward.
            </div>
            <div class="pt-5 pr-3 text-gray-800-shadow text-right">
                Straight to
                <div onclick="window.location.href = '{{route('marketplace')}}';" class="bg-gradient-to-r from-green-500 to-green-400 cursor-pointer inline-block border-2 rounded-full w-fit px-5 bg-custom-textcolor2 font-bold text-white">
                    Resellr
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white pb-7 md:h-[260px] flex justify-center items-center">
        <div class="relative sm:w-6/12 md:w-8/12">
            <div class="flex justify-center  w-full h-full sm:justify-start">
                <div class="space-y-3 w-11/12 sm:w-6/12 flex flex-col sm:justify-center">
                    <div class="text-black text-3xl sm:pl-10 pt-3 sm:pt-10 font-bold">Still have a question?</div>
                    <div class="sm:pl-10 text-opacity-90">Join our whitelist to request a demo app if you still have questions.</div>
                    <div class="w-full sm:pl-10">
                        <button class="cursor-pointer float-left text-white bg-black w-fit px-4 rounded-md py-3">Request Demo</button>
                    </div>
                </div>
            </div>
            <img class="hidden lg:block w-[350px] md:w-[450px] float-right absolute top-0 right-0" src="{{asset('img/questions.png')}}">
        </div>
    </div>
    @include('templates/footer')
</body>
<script>
    @auth
    document.getElementById('logout-button').addEventListener('click', function () {
        fetch('{{ route('ajax.logout') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
            .then(response => {
                if (response.ok) {t
                    window.location.href = '{{ route('login') }}';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
    @endauth
    async function fetchAndDisplayRecentItems() {
        try {
            const response = await fetch('/api/mostRecent');
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const items = await response.json();

            const recentItemsContainer = document.getElementById('recentItemsContainer');

            recentItemsContainer.innerHTML = '';

            items.forEach(item => {
                const itemElement = document.createElement('div');
                itemElement.className = 'mx-2 w-32 h-full select-none';
                itemElement.innerHTML = `
                    <img onclick="window.location.href='http://daiktusvetaine.test/marketplace/' + ${item.id};" class="border-custom-background1 w-44 h-40 object-cover border-4 cursor-pointer" alt="Marketplace item photo" src="${item.images[0].ImageURL}">
                    <div class="font-bold overflow-hidden overflow-ellipsis w-32">${item.Price}€</div>
                    <div class="overflow-hidden overflow-ellipsis w-32">${item.ItemName}</div>
                    <div class="font-light overflow-hidden overflow-ellipsis w-32">${item.Location}</div>
                `;
                recentItemsContainer.appendChild(itemElement);
            });
        } catch (error) {
            console.error('Error fetching recent items:', error);
        }
    }
    fetchAndDisplayRecentItems();

</script>
</html>
