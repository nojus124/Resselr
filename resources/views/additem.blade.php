<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="css/customCode.css" rel="stylesheet" type="text/css" >
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="w-full Custom-TextFont1">
@include('templates/header')
<div class="w-full">
    <h1 class="pl-3 pt-3 font-bold text-2xl text-center">Marketplace Item creation</h1>
    <div id="FilesError" class="w-full px-3 pt-3 hidden">
        <div class="flex alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>Error! More than 4 files detected.</span>
        </div>
    </div>
    <div class="w-full flex justify-center">
        <form id="PostSubmitData" method="POST" enctype="multipart/form-data" class="w-full max-w-[360px]">
            @csrf
            <div class="form-control pl-3 pr-3 ">
                <label class="label">
                    <span class="block text-sm font-medium text-gray-900 dark:text-white ">Item name:</span>
                </label>
                <input name="Title" type="text" placeholder='Book "Guardians of the galaxy" ' class="w-full input input-bordered" />
                <div id="titleError" class="text-red-500 text-sm mt-1" style="display: none;"></div>
                <div class="w-full" x-data="{ categories: [], selectedCategory: '' }" x-init="fetchCategories" :name="selectedCategory">
                    <label class="label">Category:</label>
                    <select class="select select-bordered w-full" x-model="selectedCategory" name="Category">
                        <option disabled selected></option>
                        <template x-for="category in categories" :key="category">
                            <option x-text="category" :value="category"></option>
                        </template>
                    </select>
                    <div id="categoryError" class="text-red-500 text-sm mt-1" style="display: none;"></div>
                </div>
                <div class="w-full" x-data="{ conditions: [], selectedCondition: '' }" x-init="fetchConditionsList">
                    <label class="label">Condition:</label>
                    <select class="select select-bordered w-full" x-model="selectedCondition" name="Condition">
                        <option disabled selected></option>
                        <template x-for="condition in conditions" :key="condition">
                            <option x-text="condition" :value="condition"></option>
                        </template>
                    </select>
                    <div id="conditionError" class="text-red-500 text-sm mt-1" style="display: none;"></div>
                </div>
                <div class="w-full">
                    <div>Price</div>
                    <input name="Price" type="text" placeholder='10.92 ' class="w-full input input-bordered" />
                    <div id="priceError" class="text-red-500 text-sm mt-1" style="display: none;"></div>
                </div>
                <div class="w-full">
                    <label>Description:</label>
                    <textarea type="text" name="Description" placeholder="Type description here." class="h-fit w-full flex h-auto min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                    <div id="descriptionError" class="text-red-500 text-sm mt-1" style="display: none;"></div>
                </div>
                <div class="w-full">
                    <div>Location</div>
                    <input name="Location" type="text" placeholder='Kaunas' class="w-full input input-bordered" />
                    <div id="locationError" class="text-red-500 text-sm mt-1" style="display: none;"></div>
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
                    <div id="imagesError" class="text-red-500 text-sm mt-1" style="display: none;"></div>
                </div>
                <div  class="flex justify-center w-full">
                    <div class="relative" id="image-preview">
                        <div id="ImageSelectWhich" class="hidden absolute top-1/2 left1/2 w-full">
                            <div class="w-full flex justify-between items-center">
                                <i onclick="changePrevious()" class='ml-4 text-4xl bg-white rounded-box bx bxs-chevron-left cursor-pointer hover:bg-sky-700'></i>
                                <i onclick="changeNext()" class='mr-4 text-4xl bg-white bx rounded-box bxs-chevron-right cursor-pointer hover:bg-sky-700' ></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full flex justify-center pb-3">
                    <button class="border-black border-2 w-fit rounded-full px-3 py-2 active:bg-gray-100 active:shadow-gray-300 active:shadow-lg" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@include('templates/footer')
<script>
    const fileInput = document.getElementById('button2');
    const imagePreview = document.getElementById('image-preview');
    const ErrorAlert = document.querySelector("#FilesError");
    const ImageSelectWhich = document.querySelector("#ImageSelectWhich");
    let currentPhoto = 0;

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
    function fetchCategories() {
        const accessToken = '{{auth()->user()->ApiToken}}';

        const headers = new Headers();
        headers.append('Authorization', 'Bearer ' + accessToken);
        headers.append('Content-Type', 'application/json');

        fetch('http://daiktusvetaine.test/api/getCategoryLists', {
            method: 'GET',
            headers: headers,
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                this.categories = data;
            })
            .catch(error => {
                console.error('Error fetching categories:', error);
            });
    }
    function fetchConditionsList() {
        fetch('http://daiktusvetaine.test/api/fetchConditionsList')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                this.conditions = data;
            })
            .catch(error => {
                console.error('Error fetching categories:', error);
            });
    }

    const form = document.getElementById('PostSubmitData');
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (!validateForm()) {
            return;
        }
        axios.get("{{route('GetNewApiToken')}}")
            .then((response) => {
                const bearerToken = response.data.token;

                if (bearerToken) {
                    console.log('Bearer token:', bearerToken);
                    const formData = new FormData(form);

                    axios.post("{{ route('addItemMarketplace') }}", formData, {
                        headers: {
                            Authorization: `Bearer ${bearerToken}`,
                        },
                    })
                        .then((response) => {
                            window.location.replace("{{route('marketplace')}}");
                        })
                        .catch((error) => {
                            // Handle errors
                        });
                } else {
                    console.log('Bearer token not found');
                }
            })
            .catch((error) => {
                console.error('Error fetching token:', error);
            });
    });
    function validateForm() {
        const titleInput = document.querySelector('input[name="Title"]');
        const categoryInput = document.querySelector('select[name="Category"]');
        const conditionInput = document.querySelector('select[name="Condition"]');
        const priceInput = document.querySelector('input[name="Price"]');
        const locationInput = document.querySelector('input[name="Location"]');
        const descriptionInput = document.querySelector('textarea[name="Description"]');
        const imagesInput = document.querySelector('input[name="Images[]"]');
        const maxCharacters = 50;

        document.getElementById('titleError').style.display = 'none';
        document.getElementById('categoryError').style.display = 'none';
        document.getElementById('conditionError').style.display = 'none';
        document.getElementById('locationError').style.display = 'none';
        document.getElementById('priceError').style.display = 'none';
        document.getElementById('descriptionError').style.display = 'none';
        document.getElementById('imagesError').style.display = 'none';

        const titleValue = titleInput.value.trim();
        const locationValue = locationInput.value.trim();
        if (titleValue === '') {
            const titleError = document.getElementById('titleError');
            titleError.textContent = 'Please provide an item name.';
            titleError.style.display = 'block';
            return false;
        }
        if (titleValue.length > maxCharacters) {
            const titleError = document.getElementById('titleError');
            titleError.textContent = 'Item name should not exceed 50 characters.';
            titleError.style.display = 'block';
            return false;
        }

        if(locationValue === ''){
            const locationError = document.getElementById('locationError');
            locationError.textContent = 'Please provide an location name.';
            locationError.style.display = 'block';
            return false;
        }
        // Validation for Category
        if (categoryInput.value.trim() === '') {
            const categoryError = document.getElementById('categoryError');
            categoryError.textContent = 'Please select a category.';
            categoryError.style.display = 'block';
            return false;
        }

        // Validation for Condition
        if (conditionInput.value.trim() === '') {
            const conditionError = document.getElementById('conditionError');
            conditionError.textContent = 'Please select a condition.';
            conditionError.style.display = 'block';
            return false;
        }

        // Validation for Price
        const priceValue = parseFloat(priceInput.value.trim());
        if (isNaN(priceValue) || priceValue <= 0) {
            const priceError = document.getElementById('priceError');
            priceError.textContent = 'Please provide a valid positive price.';
            priceError.style.display = 'block';
            return false;
        }

        // Validation for Description
        const descriptionValue = descriptionInput.value.trim();
        if (descriptionValue.length > 1000) {
            const descriptionError = document.getElementById('descriptionError');
            descriptionError.textContent = 'Description must be 1000 characters or less.';
            descriptionError.style.display = 'block';
            return false;
        }

        if (imagesInput.files.length === 0) {
            const imagesError = document.getElementById('imagesError');
            imagesError.textContent = 'Please upload at least one image.';
            imagesError.style.display = 'block';
            return false;
        }

        const maxFiles = 4;
        if (imagesInput.files.length > maxFiles) {
            const imagesError = document.getElementById('imagesError');
            imagesError.textContent = 'Please upload a maximum of 4 images.';
            imagesError.style.display = 'block';
            return false;
        }

        return true;
    }


    fileInput.addEventListener('change', async (event) => {
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
                    img.className = 'w-fit max-w-[350px] px-3 transition duration-300 ease-in-out hover:opacity-100';
                    first = false;
                }
                else{
                    img.className = 'w-fit max-w-[350px] hidden px-3 transition duration-300 ease-in-out hover:opacity-100';
                }
                imagePreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
        ImageSelectWhich.classList.remove("hidden");
        currentPhoto = 0;
    });
    fetchCategories();
</script>
</body>
</html>
