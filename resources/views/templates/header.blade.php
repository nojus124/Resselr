
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <div x-data="{ dropDownOpen: false}" @click.away="dropDownOpen = false">
        <div class="p-1.5 w-full flex justify-between items-center border-opacity-60 border-2">
            <a href="{{route('home')}}">
                <img class="w-[180px] h-[45px] cursor-pointer" src="{{ asset('img/logo.png') }}" alt="Logo">
            </a>
            <div class="relative">
                <img @click="dropDownOpen = !dropDownOpen" class="sm:hidden w-[50px] h-[55px] cursor-pointer" src="{{ asset('img/menu.png') }}" alt="MenuBar">
                <div class="flex hidden sm:flex space-x-2 pr-3">
                    <a class="hover:bg-accent-content/10 hover:rounded-full hover:px-3 active:bg-accent-content/25" href="{{ route('home') }}">Home</a>
                    <a class="hover:bg-accent-content/10 hover:rounded-full hover:px-3 active:bg-accent-content/25" href="{{ route('marketplace') }}">Marketplace</a>
                    @auth
                        <div class="flex">
                            <a class="hover:bg-accent-content/10 hover:rounded-full hover:px-3 active:bg-accent-content/25" href="{{ route('profile') }}"><i class='bx bxs-user'></i>Profile</a>
                        </div>
                        <form class="inline" action="{{ route('ajax.logout') }}" method="POST">
                            @csrf
                            <button class="hover:bg-accent-content/10 hover:rounded-full hover:px-3 active:bg-accent-content/25" id="logout-button" type="submit">Sign out</button>
                        </form>
                    @endauth
                    @guest
                        <a class="hover:bg-accent-content/10 hover:rounded-full hover:px-3 active:bg-accent-content/25" href="{{ route('login') }}">Login</a>
                        <a class="hover:bg-accent-content/10 hover:rounded-full hover:px-3 active:bg-accent-content/25" href="{{ route('register') }}">Register</a>
                    @endguest
                </div>
                <!-- Dropdown Content -->
                <div x-show="dropDownOpen" id="dropdown" @click.outside="dropDownOpen = false" class="z-10 absolute top-16 right-0 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li @click="dropDownOpen = false">
                            <a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white ">Home</a>
                        </li>
                        <li @click="dropDownOpen = false">
                            <a href="{{route('marketplace')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Marketplace</a>
                        </li>
                        <ul>

                            @auth
                                <li>
                                    <a href="{{route('admin.dashboard')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Admin dashboard</a>
                                </li>
                                <li>
                                    <a href="{{route('profile')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                                </li>
                                <li>
                                    <form action="{{ route('ajax.logout') }}" method="POST">
                                        @csrf
                                        <button id="logout-button-2" type="submit" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</button>
                                    </form>
                                </li>
                            @endauth
                            @guest
                                <li @click="dropDownOpen = false;">
                                    <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Login</a>
                                </li>
                                <li @click="dropDownOpen = false;">
                                    <a href="{{ route('register') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Register</a>
                                </li>
                            @endguest
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
    </div>
