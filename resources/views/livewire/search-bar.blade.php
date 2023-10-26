<div>
    <div class="flex justify-center">
        <div class="w-full sm:w-7/12 lg:w-4/12 flex justify-center h-[40px] pl-3 pr-3 mt-3 mb-3">
            <input wire:model="search" class="p-4 w-full border-2 border-r-0 border-opacity-50 border-black" placeholder="Search for anything" type="text">
            <div class="bg-blue-600 flex justify-center items-center w-10">
                <i wire:click="$refresh" class='cursor-pointer text-white bx bx-search' ></i>
            </div>
        </div>
    </div>
    <div class="flex border-b-2 pb-3">
        <div class="pl-3 text-xs sm:text-lg">Resslr</div>
        <i class='text-base sm:text-lg bx bx-chevron-right leading-12'></i>
            @if(count($selectedCategories) >0)
                @foreach($selectedCategories as $index => $category)
                <div class="text-xs">{{$category}}{{ $index == count($selectedCategories) - 1 ? '' : ',' }}</div>
                @endforeach
            @endif
    </div>
    <div class="w-full flex justify-center">
        <div class="mt-3 mb-3 flex justify-between w-full xl:w-10/12">
            <a href="{{asset(route('additem'))}}">
                <div class="ml-3 bg-custom-textcolor2  hover:bg-green-600 text-white font-bold mb-3 py-1 px-4 border-b-4 border-green-900 border-opacity-50 hover:border-green-700 rounded">Add item</div>
            </a>
            <button onclick="toggleFilterModal()" class="mr-3 bg-blue-500 hover:bg-blue-400 text-white font-bold mb-3 py-1 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                Filters
            </button>
        </div>
    </div>
    <div class="w-full pl-3 pr-3 flex justify-center">
            <div class="w-full lg:w-11/12 xl:w-9/12 flex flex-wrap">
                @foreach ($items as $index => $item)
                    <div class="h-fit w-1/2 md:w-3/12 lg:w-2/12 sm:w-1/3 mb-3">
                        <div class="px-1">
                            <div class="w-full card card-compact bg-base-100 shadow-xl">
                                <figure class="h-fit"><img class="w-full h-64 object-cover" src="{{ asset($item['images'][0]['ImageURL']) }}" alt="Shoes" /></figure>
                                <div class="card-body">
                                    <h2 class="min-h-[35px] max-h-[35px] line-clamp-1 card-title">{{ $item['ItemName'] }}</h2>
                                    <p class="min-h-[40px] max-h-[40px] line-clamp-2">{{ $item['Description'] }}</p>
                                    <div class="font-medium text-3xl stat-value">{{ $item['Price'] }}€</div>
                                    <div class="card-actions justify-end">
                                        <div class="badge badge-outline">{{ $item['category']['CategoryName'] }}</div>
                                    </div>
                                    <div class="card-actions justify-end">
                                        <button class="btn btn-primary sm:text-xl"><a href="{{ route('ItemPage', ['id' => $item['id']]) }}">Buy Now</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
    <div id="FilterModal" class="fixed inset-0 bg-opacity-50 backdrop-blur-sm z-10 flex justify-center items-center hidden">
        <div class="flex justify-center items-center w-fit  h-full">
            <div class="bg-white rounded-lg p-6 shadow-lg z-20 w-full h-fu">
                <div class="flex justify-between">
                    <div class="flex justify-center items-center">Select filters:</div>
                    <i onclick="toggleFilterModal()" class='text-black text-4xl bx bx-x'></i>
                </div>
                <div>
                    <div class="flex items-center space-x-1">
                        <input wire:model="transport" type="checkbox" id="transport">
                        <label for="transport">Transport</label>
                    </div>
                    <div class="flex items-center space-x-1">
                        <input wire:model="realEstate" type="checkbox" id="realEstate">
                        <label for="realEstate">Real Estate</label>
                    </div>
                    <div class="flex items-center space-x-1">
                        <input wire:model="jobsServices" type="checkbox" id="jobsServices">
                        <label for="jobsServices">Jobs, Services</label>
                    </div>
                    <div class="flex items-center space-x-1">
                        <input wire:model="household" type="checkbox" id="household">
                        <label for="household">Household</label>
                    </div>
                    <div class="flex items-center space-x-1">
                        <input wire:model="computers" type="checkbox" id="computers">
                        <label for="computers">Computers</label>
                    </div>
                    <div class="flex items-center space-x-1">
                        <input wire:model="communication" type="checkbox" id="communication">
                        <label for="communication">Communication</label>
                    </div>
                    <div class="flex items-center space-x-1">
                        <input wire:model="electronics" type="checkbox" id="electronics">
                        <label for="electronics">Electronics</label>
                    </div>
                    <div class="flex items-center space-x-1">
                        <input wire:model="entertainment" type="checkbox" id="entertainment">
                        <label for="entertainment">Entertainment</label>
                    </div>
                    <div class="flex items-center space-x-1">
                        <input wire:model="clothingFootwear" type="checkbox" id="clothingFootwear">
                        <label for="clothingFootwear">Clothing, Footwear</label>
                    </div>
                    <div class="flex items-center space-x-1">
                        <input wire:model="forParents" type="checkbox" id="forParents">
                        <label for="forParents">For Parents</label>
                    </div>
                </div>
                <div class="flex justify-end mt-3 mr-3">
                    <div wire:click="$refresh" class="w-fit bg-blue-500 hover:bg-blue-400 text-white font-bold mb-3 py-1 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded cursor-pointer">Save filters</div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex w-full items-center justify-center">
        @if(count($items)>0)
            @if($page-1 > 0)
                <div class="w-10 h-10 flex items-center justify-center">
                    <i class='bx bxs-chevron-left' ></i>
                </div>
            @endif
            @foreach(range(1, $page) as $index)
                <div class=" flex items-center justify-center px-3 w-fit h-10">{{$index}}</div>
            @endforeach
                @if($page < (count($items)/20))
                    <div class="w-10 h-10 flex items-center justify-center">
                        <i class='bx bxs-chevron-right' ></i>
                    </div>
                @endif
        @else
            <div class="pb-4">No items available.</div>
        @endif
    </div>
</div>
