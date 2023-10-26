<div class="Custom-TextFont1">
    <div class="w-full md:flex md:justify-center">
        <div class="md:w-11/12 lg:w-9/12 xl:w-8/12">
            <div class="font-semibold text-2xl ml-4 mt-4 mb-4">Profile</div>
        </div>
    </div>
    <div class="w-full bg-gray-100 flex justify-center">
        <div class="md:flex md:w-11/12 lg:w-9/12 xl:w-8/12">
            <div class="pl-3 pt-3 pb-3 w-full">
                <div class="text-xl font-medium">Profile Information</div>
                <div class="text-sm">Update your account's profile information and email address.</div>
            </div>
            <div class="w-full flex justify-center">
                <div class="w-11/12 max-w-lg bg-white p-4 rounded-md mb-3 sm:mt-3">
                    <div id="SuccessMessages1" class="text-green-500 text-sm"></div>
                    <form method="POST" onsubmit="return false;" id="ProfileForm" class="space-y-3">
                        @CSRF
                        <label for="FirstName" class="block text-sm font-medium text-gray-700">First name:</label>
                        <input
                            type="text"
                            id="FirstName"
                            name="FirstName"
                            value="{{auth()->user()->FirstName}}"
                            class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:ring focus:ring-opacity-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your first name"
                        >
                        <div id="firstNameError" class="text-red-500 text-sm"></div>

                        <label for="LastName" class="block text-sm font-medium text-gray-700">Last name:</label>
                        <input
                            type="text"
                            id="LastName"
                            name="LastName"
                            value="{{auth()->user()->LastName}}"
                            class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:ring focus:ring-opacity-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your last name"
                        >
                        <div id="lastNameError" class="text-red-500 text-sm"></div>

                        <label for="Email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input
                            type="text"
                            id="Email"
                            name="Email"
                            value="{{auth()->user()->Email}}"
                            class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:ring focus:ring-opacity-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your email"
                        >
                        <div id="emailError" class="text-red-500 text-sm"></div>

                        <div class="w-full text-center mt-3">
                            <button id="modalOkButton" onclick="openModal1AndSubmit()" class="cursor-pointer w-[90px] h-5 btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full md:flex md:justify-center">
        <div class="md:w-11/12 lg:w-9/12 xl:w-8/12">
            <div class="font-semibold text-2xl ml-4 mt-4 mb-4">Marketplace</div>
        </div>
    </div>
    <div class="md:flex w-full bg-gray-100 sm:justify-center">
        <div class="md:w-11/12 lg:w-9/12 xl:w-8/12 md:flex">
            <div class="pl-3 pt-3 pb-3 w-full">
                <div class="text-xl font-medium">Marketplace items</div>
                <div class="text-sm">Here, you can update existing items or delete them.</div>
            </div>
            <div class="w-full flex justify-center sm:mt-3">
                <div class="w-11/12 max-w-lg bg-white rounded-md space-y-2 mb-3">
                    <div id="SuccessMessages2" class="text-green-500 text-sm"></div>
                    @if(count($this->items) < 1)
                        <div class="pl-3">There are no items.</div>
                    @endif
                    @foreach($this->items as $index => $item)
                        <livewire:marketplace-item :$item :$index/>
                    @endforeach
                </div>
            </div>
        </div>
        <dialog id="my_modal_1" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Hey there!</h3>
                <p class="py-4">Do you really want to do this?</p>
                <form id="modalForm" class="modal-backdrop" onsubmit="return false;">
                <div class="w-full flex justify-between">
                        <button onclick="handleSubmitForm()" class="w-fit bg-green-300 rounded-lg px-3 py-2 text-black" id="ProfileFormSubmit" type="submit">Submit</button>
                        <button onclick="my_modal_1.close()" class="w-fit bg-gray-200 rounded-lg px-3 py-2 text-black" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </dialog>
            <dialog id="my_modal_2" class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Hey there!</h3>
                    <p class="py-4">Do you really want to do this?</p>
                    <form id="modalForm" class="modal-backdrop" onsubmit="return false;">
                        <div class="w-full flex justify-between">
                            <button onclick="handleSubmitForm2(ItemID)" class="w-fit bg-green-300 rounded-lg px-3 py-2 text-black" id="DeleteItemSubmit" type="submit">Submit</button>
                            <button onclick="my_modal_2.close()" class="w-fit bg-gray-200 rounded-lg px-3 py-2 text-black" type="button">Cancel</button>
                        </div>
                    </form>
                </div>
            </dialog>
        <dialog id="my_modal_3" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Item editing</h3>
                <form method="POST" action="{{route('updateDataForm')}}" id="modalForm3" class="modal-backdrop" onsubmit="return false;">
                    <div>
                        <input hidden="" type="number">
                        <label class="label">
                            <span class="block text-sm font-medium text-gray-900 dark:text-white ">Item name:</span>
                        </label>
                        <input id="TitleUpdate" name="Title" type="text" placeholder='Book "Guardians of the galaxy" ' class="text-black max-w-full input input-bordered w-full" />
                        <div id="titleError" class="text-red-500 text-sm mt-1" style="display: none;"></div>
                        <label for="Category" class="text-black label">Category:</label>
                        <select id="CategoryUpdate" class="text-black select select-bordered w-full max-w-full" name="Category">
                            <option disabled selected></option>
                            @foreach($this->categories as $category)
                                <option class="text-black">{{$category}}</option>
                            @endforeach
                        </select>
                        <div id="categoryError" class="text-red-500 text-sm mt-1" style="display: none;"></div>
                        <div>
                            <label class="label text-black">Condition:</label>
                            <select id="ConditionUpdate" class="text-black select select-bordered w-full max-w-full" name="Condition">
                                <option disabled selected></option>
                                @foreach($this->conditions as $condition)
                                    <option class="text-black">{{$condition}}</option>
                                @endforeach
                            </select>
                            <div id="conditionError" class="text-red-500 text-sm mt-1" style="display: none;"></div>
                        </div>
                        <div class="w-fit">
                            <div class="text-black">Price</div>
                            <input id="PriceUpdate" name="Price" type="text" placeholder='10.92 ' class="text-black input input-bordered w-full max-w-xs" />
                            <div id="priceError" class="text-red-500 text-sm mt-1" style="display: none;"></div>
                        </div>
                        <div class="w-full max-w-xs">
                            <label class="text-black">Description:</label>
                            <textarea id="DescriptionUpdate" type="text" name="Description" placeholder="Type description here." class="text-black h-fit flex w-full h-auto min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                            <div id="descriptionError" class="text-red-500 text-sm mt-1" style="display: none;"></div>
                        </div>
                        <div class="w-full flex justify-center flex-col items-center">
                            <div class="relative mt-3 mb-4 w-fit">
                                <label title="Click to upload" for="button2" class="cursor-pointer flex items-center gap-4 px-6 py-4 before:border-gray-400/60 hover:before:border-gray-300 group dark:before:bg-darker dark:hover:before:border-gray-500 before:bg-gray-100 dark:before:border-gray-600 before:absolute before:inset-0 before:rounded-3xl before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                                    <div class="w-max relative">
                                        <img class="w-12" src="https://www.svgrepo.com/show/485545/upload-cicle.svg" alt="file upload icon" width="512" height="512">
                                    </div>
                                    <div class="relative">
                          <span class="block text-base font-semibold relative text-blue-900 dark:text-white group-hover:text-blue-500">
                              Upload images
                          </span>
                                        <span class="mt-0.5 block text-sm text-gray-500 dark:text-gray-400">Max 4 photos</span>
                                    </div>
                                </label>
                                <input hidden="" type="file" name="Images[]" id="button2" multiple>
                            </div>
                            <div id="FilesError" class="text-red-500 text-sm mt-1" style="display: none;"></div>
                        </div>
                        <div class="flex justify-center w-full">
                            <div class="relative" id="image-preview">
                                <div id="ImageSelectWhich" class="absolute top-1/2 left1/2 w-full hidden">
                                    <div class="w-full flex justify-between items-center">
                                        <i onclick="changePrevious()" class='text-black ml-4 text-4xl bg-white rounded-box bx bxs-chevron-left cursor-pointer hover:bg-sky-700'></i>
                                        <i onclick="changeNext()" class='text-black mr-4 text-4xl bg-white bx rounded-box bxs-chevron-right cursor-pointer hover:bg-sky-700' ></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex justify-between mt-4">
                        <button onclick="handleSubmitUpdate()" class="w-fit bg-green-300 rounded-lg px-3 py-2 text-black" id="DeleteItemSubmit" type="submit">Save</button>
                        <button onclick="my_modal_3.close()" class="w-fit bg-gray-200 rounded-lg px-3 py-2 text-black" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </dialog>
        <div>
        </div>
    </div>
    <div class="w-full md:flex md:justify-center">
        <div class="md:w-11/12 lg:w-9/12 xl:w-8/12">
            <div class="font-semibold text-2xl ml-4 mt-4 mb-4">Orders</div>
        </div>
    </div>
    <div class="md:flex md:justify-center w-full bg-gray-100 sm:justify-center">
        <div class="md:w-11/12 lg:w-9/12 xl:w-8/12 md:flex">
            <div class="pl-3 pt-3 pb-3 w-full">
                <div class="text-xl font-medium">Orders</div>
                <div class="text-sm">Here, you can see your existing orders.</div>
            </div>
            <div class="w-full flex justify-center sm:mt-3">
                <div class="w-11/12 max-w-lg bg-white p-4 rounded-md space-y-2 mb-3">
                    @if(count($this->orders) < 1)
                        <div class="pl-3">There are no orders.</div>
                    @endif
                    @foreach($this->orders as $index => $order)
                        <div x-data="{ order: {{ json_encode($order) }}, item: {{ json_encode($order->item) }}, sellerEmail: '{{$order->item->seller->Email}}' }" class="flex justify-between select-none">
                            <div class="flex">
                                <div class="font-medium">{{ $index + 1 }}. {{ $order->item->ItemName }}</div>
                                <div class="font-bold pl-3">{{$order->item->Price}} €</div>
                            </div>
                            <div class="flex">
                                <div class="font-medium text-gray-500 pl-3 underline">{{$order->TransactionStatus}}</div>
                                <i @click="OrderRatingItemID = {{$order->item->id}};submitRating(order, item, sellerEmail)" class='pl-3 cursor-pointer bx bxs-star-half leading-5'></i>
                            </div>
                        </div>
                    @endforeach
                    <dialog id="my_modal_4" class="modal">
                        <div class="modal-box w-fit">
                            <h3 class="font-bold text-lg text-center">Order rating</h3>
                            <form class="space-y-1">
                                <div class="font-bold">Item name: </div>
                                <div id="OrderRatingItemName" class="text-center">Book "Hemarojus"</div>
                                <div class="font-bold">Seller:</div>
                                <div id="OrderSellerName" class="text-center">nojus124@gmail.com</div>
                                <div class="font-bold">Rating:</div>
                                <div class="rating flex justify-center pb-1.5">
                                    <input type="radio" name="rating-1" class="mask mask-star" checked />
                                    <input type="radio" name="rating-1" class="mask mask-star" />
                                    <input type="radio" name="rating-1" class="mask mask-star" />
                                    <input type="radio" name="rating-1" class="mask mask-star" />
                                    <input type="radio" name="rating-1" class="mask mask-star" />
                                </div>
                                <div class="w-full flex justify-center">
                                    <textarea id="OrderRatingDescription" class=" textarea block border-gray-400" placeholder="Tell us about your order experience."></textarea>
                                </div>
                                <div class=" w-full flex justify-center pt-3">
                                    <div onclick="saveRating()" class="cursor-pointer px-3 py-2 bg-gray-100 rounded-lg active:bg-gray-200 select-none">Submit</div>
                                </div>
                            </form>
                        </div>
                        <form method="dialog" class="modal-backdrop">
                            <button>close</button>
                        </form>
                    </dialog>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="font-semibold text-2xl mt-2"></div>
    </div>
    <div class="md:flex w-full bg-gray-100 md:justify-center">
        <div class="md:w-11/12 lg:w-9/12 xl:w-8/12 md:flex">
            <div class="pl-3 pt-3 pb-3 w-full">
                <div class="text-xl font-medium">Reviews</div>
                <div class="text-sm">Here, you can view your reviews.</div>
            </div>
            <div class="w-full flex justify-center sm:mt-3">
                <div class="w-11/12 max-w-lg bg-white p-4 rounded-md space-y-2 mb-3">
                    @if(count($this->soldItems) < 1)
                        <div class="pl-3">There are no sold items.</div>
                    @endif
                    @foreach($this->soldItems as $index => $soldItem)
                        <div x-data="{isOpen: false}">
                            <div @click="isOpen = true;" x-data="{ order: {{ json_encode($soldItem) }}, item: {{ json_encode($soldItem->item) }} }" class="flex justify-between select-none cursor-pointer">
                                <div class="flex">
                                    <div class="font-medium">{{ $index + 1 }}. {{ $soldItem->item->ItemName }}</div>
                                    <div class="font-bold pl-3">{{$soldItem->item->Price}} €</div>
                                </div>
                                <div class="flex">
                                    <div class="font-medium text-gray-500 pl-3 underline">{{$soldItem->TransactionStatus}}</div>
                                </div>
                            </div>
                            <div @click="isOpen = false;" x-show="isOpen" class="select-none cursor-pointer bg-gray-100 rounded-lg px-2 py-1">
                                <div class="font-bold">Buyer review:</div>
                                @if(isset($soldItem->reviews[0]->Description))
                                    <div>{{$soldItem->reviews[0]->Description}}</div>
                                @else
                                    <div class="text-red-500">This item is not reviewed by buyer.</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        const fileInput = document.getElementById('button2');
        const imagePreview = document.getElementById('image-preview');
        const ErrorAlert = document.querySelector("#FilesError");
        const ImageSelectWhich = document.querySelector("#ImageSelectWhich");
        let OrderRatingItemID;
        const listenerButton = {
            checkbox: false,
        };
        let ItemID;
        let imageURLS;
        let SelectedRowUpdate;
        let ImagesUploaded = false;
        function submitRating(order, item, seller){
            document.getElementById("OrderRatingItemName").textContent = item.ItemName;
            document.getElementById("OrderSellerName").textContent = seller;
            my_modal_4.showModal();
        }
        function saveRating(){
            const ratingDiv = document.querySelector('.rating');
            const OrderDescription = document.getElementById('OrderRatingDescription').value;
            const radioInputs = ratingDiv.querySelectorAll('input[type="radio"]');
            const count = radioInputs.length;
            console.log("submitted");
            axios.get("{{ route('GetNewApiToken') }}")
                .then((response) => {
                    const bearerToken = response.data.token;

                    if (bearerToken) {
                        const formData = new FormData();
                        formData.append('Id', OrderRatingItemID);
                        formData.append('Rating', count);
                        formData.append('Description', OrderDescription);
                        axios.post(
                            "{{ route('updateOrderRating') }}",
                            formData,
                            {
                                headers: {
                                    Authorization: `Bearer ${bearerToken}`,
                                    'Content-Type': 'multipart/form-data',
                                }
                            }
                        )
                            .then((response) => {
                                window.location.replace("{{route('profile')}}");
                            })
                            .catch((error) => {
                                if (error.response && error.response.data && error.response.data.errors) {
                                    const errors = error.response.data.errors;
                                } else {
                                    console.error('Error fetching user item:', error);
                                }
                            });
                    } else {
                        console.log('Bearer token not found');
                    }
                })
                .catch((error) => {
                    console.error('Error fetching token:', error);
                });
        }
        function handleSubmitUpdate() {
            axios.get("{{ route('GetNewApiToken') }}")
                .then((response) => {
                    const bearerToken = response.data.token;

                    if (bearerToken) {
                        const formData = new FormData();
                        formData.append('Title', document.getElementById('TitleUpdate').value);
                        formData.append('Price', document.getElementById('PriceUpdate').value);
                        formData.append('Description', document.getElementById('DescriptionUpdate').value);
                        formData.append('Category', document.getElementById('CategoryUpdate').value);
                        formData.append('Condition', document.getElementById('ConditionUpdate').value);
                        formData.append('ItemID', SelectedRowUpdate);
                        if(ImagesUploaded){
                            const fileInput = document.getElementById('button2');

                            if (fileInput.files.length > 0) {
                                for (let i = 0; i < fileInput.files.length; i++) {
                                    formData.append('Images[]', fileInput.files[i]);
                                }
                            }
                            ImagesUploaded = false;
                        }
                        axios.post(
                            "{{ route('updateDataForm') }}",
                            formData,
                            {
                                headers: {
                                    Authorization: `Bearer ${bearerToken}`,
                                    'Content-Type': 'multipart/form-data',
                                }
                            }
                        )
                            .then((response) => {
                                window.location.replace("{{route('profile')}}");
                            })
                            .catch((error) => {
                                if (error.response && error.response.data && error.response.data.errors) {
                                    const errors = error.response.data.errors;
                                } else {
                                    console.error('Error fetching user item:', error);
                                }
                            });
                    } else {
                        console.log('Bearer token not found');
                    }
                })
                .catch((error) => {
                    console.error('Error fetching token:', error);
                });
        }
        function updateTable(ItemID) {
            axios.get("{{ route('GetNewApiToken') }}")
                .then((response) => {
                    const bearerToken = response.data.token;

                    if (bearerToken) {
                        axios.get(`{{ route('getUserItem') }}?ItemID=${ItemID}`, {
                            headers: {
                                Authorization: `Bearer ${bearerToken}`,
                            }
                        })
                            .then((response) => {
                                const item = response.data.item;

                                if (item) {
                                    const title = document.getElementById('TitleUpdate');
                                    const price = document.getElementById('PriceUpdate');
                                    const description = document.getElementById('DescriptionUpdate');
                                    const category = document.getElementById('CategoryUpdate');
                                    const condition = document.getElementById('ConditionUpdate');
                                    const images = document.getElementById('button2');
                                    title.value = item.ItemName;
                                    price.value = item.Price;
                                    description.value = item.Description;
                                    category.selectedIndex = item.CategoryID;
                                    condition.selectedIndex = item.Condition;
                                    imageURLS = item.images;
                                    updatePicture(item.images);
                                    my_modal_3.showModal();
                                } else {
                                    console.log('User has no associated item');
                                }
                            })
                            .catch((error) => {
                                if (error.response && error.response.data && error.response.data.errors) {
                                    const errors = error.response.data.errors;
                                } else {
                                    console.error('Error fetching user item:', error);
                                }
                            });
                    } else {
                        console.log('Bearer token not found');
                    }
                })
                .catch((error) => {
                    console.error('Error fetching token:', error);
                });
        }
        function updatePicture(imageFileNames){
            const imagePreview = document.getElementById('image-preview');
            let first = true;
            clear();
            for (const filePath of imageFileNames) {
                const img = document.createElement('img');
                img.src = filePath;

                if (first) {
                    img.className = 'w-full px-3 transition duration-300 ease-in-out hover:opacity-100';
                    first = false;
                } else {
                    img.className = 'w-full hidden px-3 transition duration-300 ease-in-out hover:opacity-100';
                }

                imagePreview.appendChild(img);
            }
            const ImageSelectWhich = document.getElementById('ImageSelectWhich');
            ImageSelectWhich.classList.remove("hidden");
            currentPhoto = 0;
        }
        function changeNext(){
            const ImagesCarousel = document.querySelectorAll("#image-preview > img");
            if(ImagesCarousel.length > currentPhoto+1)
            {
                currentPhoto++;
                for(let i = 0;i < ImagesCarousel.length;i++)
                {
                    ImagesCarousel[i].classList.add("hidden");
                }
                ImagesCarousel[currentPhoto].classList.remove("hidden");
            }
        }
        function clear(){
            const imageClear = document.querySelectorAll("#image-preview > img");
            for(let i = 0; i < imageClear.length;i++)
            {
                imagePreview.removeChild(imageClear[i]);
            }
        }
        function changePrevious(){
            const ImagesCarousel = document.querySelectorAll("#image-preview > img");
            if(currentPhoto-1 > -1)
            {
                currentPhoto--;
                for(let i = 0;i < ImagesCarousel.length;i++)
                {
                    ImagesCarousel[i].classList.add("hidden");
                }
                ImagesCarousel[currentPhoto].classList.remove("hidden");
            }
        }
        function OpenModal2(){
                my_modal_2.showModal();
        }
        fileInput.addEventListener('change', async (event) => {
            ImagesUploaded = true;
            const maxFiles = 4;
            const selectedFiles = event.target.files;
            if (selectedFiles.length > maxFiles) {
                ErrorAlert.classList.remove("hidden");
                ImageSelectWhich.classList.add("hidden");
                event.target.value = '';
                while (imagePreview.firstChild) {
                    imagePreview.removeChild(imagePreview.firstChild);
                }
                return;
            }
            else{
                ErrorAlert.classList.add("hidden");
            }
            const imagePreview = document.getElementById('image-preview');
            let first = true;
            clear();
            for (const file of selectedFiles) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    if(first){
                        img.className = 'w-full px-3 transition duration-300 ease-in-out hover:opacity-100';
                        first = false;
                    }
                    else{
                        img.className = 'w-full hidden px-3 transition duration-300 ease-in-out hover:opacity-100';
                    }
                    imagePreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
            ImageSelectWhich.classList.remove("hidden");
            currentPhoto = 0;
        });
        function handleSubmitForm2(ItemID) {
            my_modal_2.close();
            axios.get("{{ route('GetNewApiToken') }}")
                .then((response) => {
                    const bearerToken = response.data.token;

                    if (bearerToken) {
                        axios.delete("{{ route('deleteUserItem') }}", {
                            headers: {
                                Authorization: `Bearer ${bearerToken}`,
                            },
                            data: {
                                ItemID: ItemID,
                            },
                        })
                            .then((response) => {
                                const successMessage = response.data.message;

                                if (successMessage) {
                                    const successMessagesDiv = document.getElementById('SuccessMessages2');
                                    if (successMessagesDiv) {
                                        successMessagesDiv.textContent = successMessage;
                                        location.reload();
                                    }
                                }
                            })
                            .catch((error) => {
                                if (error.response && error.response.data && error.response.data.errors) {
                                    const errors = error.response.data.errors;
                                } else {
                                    console.error('Error deleting item:', error);
                                }
                            });
                    } else {
                        console.log('Bearer token not found');
                    }
                })
                .catch((error) => {
                    console.error('Error fetching token:', error);
                });
        }
        function openModal1AndSubmit() {
            if(validateForm()){
                my_modal_1.showModal();
            }
        }
        function handleSubmitForm() {
            listenerButton.checkbox = false;
            my_modal_1.close();
            const form = document.getElementById('ProfileForm');

            axios.get("{{ route('GetNewApiToken') }}")
                .then((response) => {
                    const bearerToken = response.data.token;

                    if (bearerToken) {
                        const formData = new FormData(form);
                        axios.post("{{ route('updateProfile') }}", formData, {
                            headers: {
                                Authorization: `Bearer ${bearerToken}`,
                            },
                        })
                            .then((response) => {
                                const successMessage = response.data.message;

                                if (successMessage) {
                                    const successMessagesDiv = document.getElementById('SuccessMessages1');
                                    if (successMessagesDiv) {
                                        successMessagesDiv.textContent = successMessage;
                                    }
                                }
                            })
                            .catch((error) => {
                                if (error.response && error.response.data && error.response.data.errors) {
                                    const errors = error.response.data.errors;
                                    const firstNameError = document.getElementById('firstNameError');
                                    const lastNameError = document.getElementById('lastNameError');
                                    const emailError = document.getElementById('emailError');
                                    const successMessagesDiv = document.getElementById('SuccessMessages');
                                    successMessagesDiv.textContent = '';
                                    firstNameError.textContent = '';
                                    lastNameError.textContent = '';
                                    emailError.textContent = '';

                                    if (errors.FirstName) {
                                        firstNameError.textContent = errors.FirstName[0];
                                    }

                                    if (errors.LastName) {
                                        lastNameError.textContent = errors.LastName[0];
                                    }

                                    if (errors.Email) {
                                        emailError.textContent = errors.Email[0];
                                    }
                                } else {
                                    console.error('Error updating profile:', error);
                                }
                            });
                    } else {
                        console.log('Bearer token not found');
                    }
                })
                .catch((error) => {
                    console.error('Error fetching token:', error);
                });
        }


        function validateForm() {
            const firstNameInput = document.getElementById('FirstName');
            const lastNameInput = document.getElementById('LastName');
            const emailInput = document.getElementById('Email');

            const firstNameError = document.getElementById('firstNameError');
            const lastNameError = document.getElementById('lastNameError');
            const emailError = document.getElementById('emailError');

            firstNameError.textContent = '';
            lastNameError.textContent = '';
            emailError.textContent = '';

            const firstNameValue = firstNameInput.value.trim();
            const lastNameValue = lastNameInput.value.trim();
            const emailValue = emailInput.value.trim();

            if (!/^[a-zA-Z]+$/.test(firstNameValue)) {
                firstNameError.textContent = 'Please provide a valid first name with only letters.';
                return false;
            }

            if (!/^[a-zA-Z]+$/.test(lastNameValue)) {
                lastNameError.textContent = 'Please provide a valid last name with only letters.';
                return false;
            }

            if (firstNameValue === '') {
                firstNameError.textContent = 'Please provide your first name.';
                return false;
            }

            if (lastNameValue === '') {
                lastNameError.textContent = 'Please provide your last name.';
                return false;
            }

            if (emailValue === '') {
                emailError.textContent = 'Please provide your email.';
                return false;
            }
            if (!emailValue.includes('@')) {
                emailError.textContent = 'Please provide a valid email address.';
                return false;
            }
            return true;
        }
    </script>
