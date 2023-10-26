<!doctype html>
<html x-data="app">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="css/customCode.css" rel="stylesheet" type="text/css" >
</head>
<body class="w-full Custom-TextFont1">
@include('templates/header')
<div class="w-full flex flex-col justify-center items-center pt-3 pb-3">
    <div class="w-10/12">
        <div class="w-fit px-5 py-3 rounded-md bg-custom-background1 font-medium">Administration panel</div>
    </div>
    <div x-data="{ activeSection: 'Users' }" class="md:w-7/12 w-full pt-3">
        <div class="bg-custom-background1 mb-3 rounded-md">
            <div class="flex pt-3 pb-3 justify-center space-x-3">
                <div @click="activeSection = 'Users';currentPage: 1;fetchData();" id="Users" class="cursor-pointer active:animate-fade active:animate-once active:animate-delay-100 select-none data-section px-2 hover:bg-white active:bg-opacity-30 rounded-md">
                    Users Data
                </div>
                <div @click="activeSection = 'Transactions';currentPage: 1;fetchData();" id="Transactions" class="cursor-pointer active:animate-fade active:animate-once active:animate-delay-100 select-none data-section px-2 hover:bg-white active:bg-opacity-30 rounded-md">
                    <!-- Transactions Data Goes Here -->
                    Transactions Data
                </div>
                <div @click="activeSection = 'Items';currentPage: 1;fetchData();" id="Items" class="cursor-pointer active:animate-fade active:animate-once active:animate-delay-100 select-none data-section px-2 hover:bg-white active:bg-opacity-30 rounded-md">
                    <!-- Items Data Goes Here -->
                    Items Data
                </div>
                <div @click="activeSection = 'Reviews';currentPage: 1;fetchData();" id="Reviews" class="cursor-pointer active:animate-fade active:animate-once active:animate-delay-100 select-none data-section px-2 hover:bg-white active:bg-opacity-30 rounded-md">
                    <!-- Reviews Data Goes Here -->
                    Reviews Data
                </div>
        </div>
        </div>
            <div class="bg-custom-background1 rounded-md pt-3">
                <div class="w-full px-4 flex justify-center pb-3">
                    <div class="relative text-gray-600">
                        <input
                            x-model="searchQuery"
                            type="text"
                            class="border-2 border-gray-300 bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none focus:border-blue-500"
                            placeholder="Search..."
                            @input="filterData()"
                        >
                        <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M9 3C5.686 3 3 5.686 3 9s2.686 6 6 6c1.357 0 2.605-.447 3.627-1.197l8.817 8.818c.097.098.225.146.354.146s.256-.049.354-.146c.195-.195.195-.511 0-.707L15.207 15.91A5.968 5.968 0 0 0 18 9c0-3.314-2.686-6-6-6zm0 2a4 4 0 0 1 4 4c0 1.255-.475 2.458-1.337 3.415L16 14.586l-3.585-3.585A4 4 0 0 1 9 5z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div x-show.transition.opacity.scale.300="activeSection === 'Users'" class="ml-3 mr-3">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">ID</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">First Name</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Last Name</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Email</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template x-for="user in FilteredData" :key="user.id">
                            <tr>
                                <td class="border px-4 py-2" x-text="user.id"></td>
                                <td class="border px-4 py-2" x-text="user.FirstName"></td>
                                <td class="border px-4 py-2" x-text="user.LastName"></td>
                                <td class="border px-4 py-2" x-text="user.Email"></td>
                                <td class="border px-4 py-2 flex justify-center">
                                    <button
                                        @click="editData(user)"
                                        class="cursor-pointer select-none bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded-md transition duration-300 mr-3"
                                    >
                                        Update
                                    </button>
                                    <div class="cursor-pointer select-none bg-red-500 rounded-full flex justify-center items-center" @click="deleteData(user.id)">
                                        <i class='bx bx-x text-center text-lg w-fit px-2'></i>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                    <div class="w-full flex justify-center">
                        <div class="flex w-full items-center justify-center">
                            <div class="w-10 h-10 flex items-center justify-center" x-show="currentPage > 1" @click="decrementPage">
                                <i class='bx bxs-chevron-left cursor-pointer' ></i>
                            </div>
                            <div class=" flex items-center justify-center px-3 w-fit h-10" x-text="currentPage"></div>
                            <div class="w-10 h-10 flex items-center justify-center" x-show="totalData > currentPage * dataPerPage" @click="incrementPage">
                                <i class='bx bxs-chevron-right cursor-pointer' ></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show.transition.opacity.scale.300="activeSection === 'Transactions'" class="ml-3 mr-3">
                    <dialog x-data="modalData" id="my_modal_4" class="modal">
                        <div class="modal-box animate-fade animate-delay-500">
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <h3 class="font-bold text-lg pb-3">Transactions data!</h3>
                            <div x-show="transaction">
                                <form id="UpdateTransaction" method="POST" action="../api/admin/submitTransaction">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="transactionId">
                                            Transaction ID:
                                        </label>
                                        <input
                                            x-model="transaction.id"
                                            type="text"
                                            id="transactionId"
                                            name="transactionId"
                                            class="border rounded-lg px-3 py-2 w-full"
                                            disabled
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="buyerId">
                                            Buyer ID:
                                        </label>
                                        <input
                                            x-model="transaction.BuyerID"
                                            type="text"
                                            id="TransactionBuyerId"
                                            name="buyerId"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="sellerId">
                                            Seller ID:
                                        </label>
                                        <input
                                            x-model="transaction.SellerID"
                                            type="text"
                                            id="TransactionSellerId"
                                            name="sellerId"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="itemId">
                                            Item ID:
                                        </label>
                                        <input
                                            x-model="transaction.ItemID"
                                            type="text"
                                            id="TransactionItemId"
                                            name="itemId"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="transactionDate">
                                            Transaction Date:
                                        </label>
                                        <input
                                            x-model="transaction.TransactionDate"
                                            type="text"
                                            id="transactionDate"
                                            name="transactionDate"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="transactionStatus">
                                            Transaction Status:
                                        </label>
                                        <input
                                            x-model="transaction.TransactionStatus"
                                            type="text"
                                            id="transactionStatus"
                                            name="transactionStatus"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="createdAt">
                                            Created At:
                                        </label>
                                        <input
                                            x-model="transaction.created_at"
                                            type="text"
                                            id="transactionCreatedAt"
                                            name="createdAt"
                                            class="border rounded-lg px-3 py-2 w-full"
                                            disabled
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="updatedAt">
                                            Updated At:
                                        </label>
                                        <input
                                            x-model="transaction.updated_at"
                                            type="text"
                                            id="transactionUpdatedAt"
                                            name="updatedAt"
                                            class="border rounded-lg px-3 py-2 w-full"
                                            disabled
                                        />
                                    </div>

                                    <div class="mt-4">
                                        <button
                                            @click="submitData(transaction)"
                                            type="button"
                                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg"
                                        >
                                            Update
                                        </button>
                                    </div>
                                    <input class="hidden" type="submit" value="Submit">
                                </form>
                            </div>
                        </div>
                    </dialog>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">ID</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Buyer ID</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Seller ID</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Item ID</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Transaction Date</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Transaction Status</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template x-for="transaction in FilteredData" :key="transaction.id">
                            <tr>
                                <td class="border px-4 py-2" x-text="transaction.id"></td>
                                <td class="border px-4 py-2" x-text="transaction.BuyerID"></td>
                                <td class="border px-4 py-2" x-text="transaction.SellerID"></td>
                                <td class="border px-4 py-2" x-text="transaction.ItemID"></td>
                                <td class="border px-4 py-2" x-text="transaction.TransactionDate"></td>
                                <td class="border px-4 py-2" x-text="transaction.TransactionStatus"></td>
                                <td class="border px-4 py-2 flex justify-center">
                                    <button
                                        @click="editData(transaction)"
                                        class="cursor-pointer select-none bg-blue-500 hover-bg-blue-600 text-white py-1 px-2 rounded-md transition duration-300 mr-3"
                                    >
                                        Update
                                    </button>
                                    <div class="cursor-pointer select-none bg-red-500 rounded-full flex justify-center items-center" @click="deleteData(transaction.id)">
                                        <i class='bx bx-x text-center text-lg w-fit px-2'></i>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                    <div class="w-full flex justify-center">
                        <div class="flex w-full items-center justify-center">
                            <div class="w-10 h-10 flex items-center justify-center" x-show="currentPage > 1" @click="decrementPage">
                                <i class='bx bxs-chevron-left cursor-pointer'></i>
                            </div>
                            <div class="flex items-center justify-center px-3 w-fit h-10" x-text="currentPage"></div>
                            <div class="w-10 h-10 flex items-center justify-center" x-show="totalData > currentPage * dataPerPage" @click="incrementPage">
                                <i class='bx bxs-chevron-right cursor-pointer'></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show.transition.opacity.scale.300="activeSection === 'Items'" class="ml-3 mr-3">
                    <dialog x-data="modalData" id="my_modal_5" class="modal">
                        <div class="modal-box animate-fade animate-delay-500">
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <h3 class="font-bold text-lg pb-3">Items data!</h3>
                            <div x-show="item">
                                <form id="UpdateItem" method="POST" action="../api/admin/submitItem">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="itemId">
                                            Item ID:
                                        </label>
                                        <input
                                            x-model="item.id"
                                            type="text"
                                            id="itemId"
                                            name="id"
                                            class="border rounded-lg px-3 py-2 w-full"
                                            disabled
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="sellerId">
                                            Seller ID:
                                        </label>
                                        <input
                                            x-model="item.SellerID"
                                            type="text"
                                            id="ItemSellerId"
                                            name="sellerId"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryId">
                                            Category ID:
                                        </label>
                                        <input
                                            x-model="item.CategoryID"
                                            type="text"
                                            id="categoryId"
                                            name="categoryId"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="itemName">
                                            Item Name:
                                        </label>
                                        <input
                                            x-model="item.ItemName"
                                            type="text"
                                            id="itemName"
                                            name="itemName"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                            Description:
                                        </label>
                                        <textarea
                                            x-model="item.Description"
                                            id="description"
                                            name="description"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        ></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                                            Price:
                                        </label>
                                        <input
                                            x-model="item.Price"
                                            type="text"
                                            id="price"
                                            name="price"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="condition">
                                            Condition:
                                        </label>
                                        <input
                                            x-model="item.Condition"
                                            type="text"
                                            id="condition"
                                            name="condition"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="location">
                                            Location:
                                        </label>
                                        <input
                                            x-model="item.Location"
                                            type="text"
                                            id="location"
                                            name="location"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="uploadDate">
                                            Upload Date:
                                        </label>
                                        <input
                                            x-model="item.UploadDate"
                                            type="text"
                                            id="uploadDate"
                                            name="uploadDate"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="createdAt">
                                            Created At:
                                        </label>
                                        <input
                                            x-model="item.created_at"
                                            type="text"
                                            id="ItemCreatedAt"
                                            name="createdAt"
                                            class="border rounded-lg px-3 py-2 w-full"
                                            disabled
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="updatedAt">
                                            Updated At:
                                        </label>
                                        <input
                                            x-model="item.updated_at"
                                            type="text"
                                            id="ItemUpdatedAt"
                                            name="updatedAt"
                                            class="border rounded-lg px-3 py-2 w-full"
                                            disabled
                                        />
                                    </div>

                                    <div class="mt-4">
                                        <button @click="submitData(item)" type="button" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
                                            Update
                                        </button>
                                    </div>
                                    <input class="hidden" type="submit" value="Submit">
                                </form>
                            </div>
                        </div>
                    </dialog>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">ID</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">SellerID</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Category</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Item Name</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Location</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template x-for="item in FilteredData" :key="item.id">
                            <tr>
                                <td class="border px-4 py-2" x-text="item.id"></td>
                                <td class="border px-4 py-2" x-text="item.SellerID"></td>
                                <td class="border px-4 py-2" x-text="item.CategoryID"></td>
                                <td class="border px-4 py-2" x-text="item.ItemName"></td>
                                <td class="border px-4 py-2" x-text="item.Location"></td>
                                <td class="border px-4 py-2 flex justify-center">
                                    <button
                                        @click="editData(item)"
                                        class="cursor-pointer select-none bg-blue-500 hover-bg-blue-600 text-white py-1 px-2 rounded-md transition duration-300 mr-3"
                                    >
                                        Update
                                    </button>
                                    <div class="cursor-pointer select-none bg-red-500 rounded-full flex justify-center items-center" @click="deleteData(item.id)">
                                        <i class='bx bx-x text-center text-lg w-fit px-2'></i>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                    <div class="w-full flex justify-center">
                        <div class="flex w-full items-center justify-center">
                            <div class="w-10 h-10 flex items-center justify-center" x-show="currentPage > 1" @click="decrementPage">
                                <i class='bx bxs-chevron-left cursor-pointer'></i>
                            </div>
                            <div class="flex items-center justify-center px-3 w-fit h-10" x-text="currentPage"></div>
                            <div class="w-10 h-10 flex items-center justify-center" x-show="totalData > currentPage * dataPerPage" @click="incrementPage">
                                <i class='bx bxs-chevron-right cursor-pointer'></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show.transition.opacity.scale.300="activeSection === 'Reviews'" class="ml-3 mr-3">
                    <dialog id="my_modal_6" class="modal">
                        <div class="modal-box animate-fade animate-delay-500">
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <h3 class="font-bold text-lg pb-3">Reviews data!</h3>
                            <div x-show="item">
                                <form id="UpdateReview" method="POST" action="../api/admin/submitReview">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="reviewId">
                                            Review ID:
                                        </label>
                                        <input
                                            x-model="review.id"
                                            type="text"
                                            id="reviewId"
                                            name="id"
                                            class="border rounded-lg px-3 py-2 w-full"
                                            disabled
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="reviewTransactionID">
                                            Transaction id:
                                        </label>
                                        <input
                                            x-model="review.TransactionID"
                                            type="text"
                                            id="reviewTransactionID"
                                            name="reviewTransactionID"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        />
                                    </div>


                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="rate">
                                        Rate:
                                        </label>
                                        <input
                                            x-model="review.Rate"
                                            type="text"
                                            id="reviewRate"
                                            name="rate"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                            Description:
                                        </label>
                                        <textarea
                                            x-model="review.Description"
                                            id="reviewDescription"
                                            name="description"
                                            class="border rounded-lg px-3 py-2 w-full"
                                        ></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="createdAt">
                                            Created At:
                                        </label>
                                        <input
                                            x-model="review.created_at"
                                            type="text"
                                            id="reviewCreatedAt"
                                            name="createdAt"
                                            class="border rounded-lg px-3 py-2 w-full"
                                            disabled
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="updatedAt">
                                            Updated At:
                                        </label>
                                        <input
                                            x-model="review.updated_at"
                                            type="text"
                                            id="reviewUpdatedAt"
                                            name="updatedAt"
                                            class="border rounded-lg px-3 py-2 w-full"
                                            disabled
                                        />
                                    </div>

                                    <div class="mt-4">
                                        <button @click="submitData(review)" type="button" class="bg-blue-500 hover-bg-blue-600 text-white py-2 px-4 rounded-lg">
                                            Update
                                        </button>
                                    </div>
                                    <input class="hidden" type="submit" value="Submit">
                                </form>
                            </div>
                        </div>
                    </dialog>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">ID</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Transaction ID</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Rate</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Description</th>
                            <th class="px-4 py-2 bg-gray-200 text-gray-700 text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template x-for="review in FilteredData" :key="review.id">
                            <tr>
                                <td class="border px-4 py-2" x-text="review.id"></td>
                                <td class="border px-4 py-2" x-text="review.TransactionID"></td>
                                <td class="border px-4 py-2" x-text="review.Rate"></td>
                                <td class="border px-4 py-2" x-text="review.Description"></td>
                                <td class="border px-4 py-2 flex justify-center">
                                    <button
                                        @click="editData(review)"
                                        class="cursor-pointer select-none bg-blue-500 hover-bg-blue-600 text-white py-1 px-2 rounded-md transition duration-300 mr-3"
                                    >
                                        Update
                                    </button>
                                    <div class="cursor-pointer select-none bg-red-500 rounded-full flex justify-center items-center" @click="deleteData(review.id)">
                                        <i class='bx bx-x text-center text-lg w-fit px-2'></i>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                    <div class="w-full flex justify-center">
                        <div class="flex w-full items-center justify-center">
                            <div class="w-10 h-10 flex items-center justify-center" x-show="currentPage > 1" @click="decrementPage">
                                <i class='bx bxs-chevron-left cursor-pointer'></i>
                            </div>
                            <div class="flex items-center justify-center px-3 w-fit h-10" x-text="currentPage"></div>
                            <div class="w-10 h-10 flex items-center justify-center" x-show="totalData > currentPage * dataPerPage" @click="incrementPage">
                                <i class='bx bxs-chevron-right cursor-pointer'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <dialog x-data="modalData" id="my_modal_3" class="modal">
        <div class="modal-box animate-fade animate-delay-500">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg pb-3">User data!</h3>
            <div x-show="user">
                <form id="UpdateUser" method="POST" action="../api/admin/submitUsers">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="id">
                            ID:
                        </label>
                        <input
                            x-model="user.id"
                            type="text"
                            id="id"
                            name="id"
                            class="border rounded-lg px-3 py-2 w-full"
                            disabled
                        />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="firstName">
                            First Name:
                        </label>
                        <input
                            x-model="user.FirstName"
                            type="text"
                            id="firstName"
                            name="firstName"
                            class="border rounded-lg px-3 py-2 w-full"
                        />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="lastName">
                            Last Name:
                        </label>
                        <input
                            x-model="user.LastName"
                            type="text"
                            id="lastName"
                            name="lastName"
                            class="border rounded-lg px-3 py-2 w-full"
                        />
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input
                            x-model="user.Email"
                            type="email"
                            id="email"
                            name="email"
                            class="border rounded-lg px-3 py-2 w-full"
                            autocomplete="email"
                        />
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                        <input
                            x-model="user.Password"
                            type="password"
                            id="password"
                            name="password"
                            class="border rounded-lg px-3 py-2 w-full"
                            autocomplete="new-password"
                        />
                    </div>

                    <div class="mb-4">
                        <label for="phoneNumber" class="block text-gray-700 text-sm font-bold mb-2">Phone Number:</label>
                        <input
                            x-model="user.PhoneNumber"
                            type="tel"
                            id="phoneNumber"
                            name="phoneNumber"
                            class="border rounded-lg px-3 py-2 w-full"
                            autocomplete="tel"
                        />
                    </div>

                    <div class="mb-4">
                        <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City:</label>
                        <input
                            x-model="user.City"
                            type="text"
                            id="city"
                            name="city"
                            class="border rounded-lg px-3 py-2 w-full"
                            autocomplete="address-level2"
                            x-data="{ debugCity: user.City }"
                            x-init="console.log('Debug City:', debugCity)"
                        />
                    </div>

                    <div class="mb-4">
                        <label for="street" class="block text-gray-700 text-sm font-bold mb-2">Street:</label>
                        <input
                            x-model="user.Street"
                            type="text"
                            id="street"
                            name="street"
                            class="border rounded-lg px-3 py-2 w-full"
                        />
                    </div>

                    <div class="mb-4">
                        <label for="streetNumber" class="block text-gray-700 text-sm font-bold mb-2">Street Number:</label>
                        <input
                            x-model="user.StreetNumber"
                            type="text"
                            id="streetNumber"
                            name="streetNumber"
                            class="border rounded-lg px-3 py-2 w-full"
                        />
                    </div>

                    <div class="mb-4">
                        <label for="createdAt" class="block text-gray-700 text-sm font-bold mb-2">Created At:</label>
                        <input
                            x-model="user.created_at"
                            type="text"
                            id="UserCreatedAt"
                            name="createdAt"
                            class="border rounded-lg px-3 py-2 w-full"
                            disabled
                        />
                    </div>

                    <div class="mb-4">
                        <label for="updatedAt" class="block text-gray-700 text-sm font-bold mb-2">Updated At:</label>
                        <input
                            x-model="user.updated_at"
                            type="text"
                            id="UserUpdatedAt"
                            name="updatedAt"
                            class="border rounded-lg px-3 py-2 w-full"
                            disabled
                        />
                    </div>

                    <div class="mt-4">
                        <button
                            @click="submitData(user)"
                            type="button"
                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg"
                            @click="updateUserData"
                        >
                            Update
                        </button>
                    </div>
                    <input class="hidden" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </dialog>
</div>
@include('templates/footer')
</body>
<script x-init="fetchData()">
    const app = {
        activeSection: 'Users',
        originalData: [],
        currentPage: 1,
        dataPerPage: 20,
        searchQuery: '',
        totalData: 0,
        FilteredData: [],
        user: {
            id: null,
            FirstName: '',
            LastName: '',
            Email: '',
            Password: '',
            PhoneNumber: '',
            City: '',
            Street: '',
            StreetNumber: '',
            created_at: '',
            updated_at: '',
        },
        transaction: {
            id: null,
            BuyerID: null,
            SellerID: null,
            ItemID: null,
            TransactionDate: '',
            TransactionStatus: '',
            created_at: '',
            updated_at: '',
        },
        item: {
            id: null,
            SellerID: null,
            CategoryID: null,
            ItemName: '',
            Description: '',
            Price: null,
            Condition: 0,
            Location: '',
            UploadDate: '',
            created_at: null,
            updated_at: null,
        },
        review: {
            id: null,
            TransactionID: null,
            Rate: null,
            Description: '',
            created_at: null,
            updated_at: null,
        },
        async deleteData(id) {
            if (confirm("Are you sure you want to delete this data?")) {
                try {
                    if (this.activeSection === 'Users') {
                        const response = await fetch(`/api/admin/deleteUser?id=${id}`, {
                            method: 'DELETE',
                        });

                        if (!response.ok) {
                            throw new Error(`Failed to delete user (HTTP ${response.status})`);
                        }

                        const responseData = await response.json();

                        if (responseData.message === 'User deleted successfully') {
                            const index = this.originalData.findIndex(user => user.id === id);
                            if (index !== -1) {
                                this.users.splice(index, 1);
                                this.filterData();
                            }
                        } else {
                            alert('Failed to delete user.');
                        }
                    } else if (this.activeSection === 'Transactions') {
                        const response = await fetch(`/api/admin/deleteTransaction?id=${id}`, {
                            method: 'DELETE',
                        });

                        if (!response.ok) {
                            throw new Error(`Failed to delete transaction (HTTP ${response.status})`);
                        }

                        const responseData = await response.json();

                        if (responseData.message === 'Transaction deleted successfully') {
                            const index = this.originalData.findIndex(transaction => transaction.id === id);
                            if (index !== -1) {
                                this.originalData.splice(index, 1);
                                this.filterData();
                            }
                        } else {
                            alert('Failed to delete transaction.');
                        }
                    } else if (this.activeSection === 'Items') {
                        const response = await fetch(`/api/admin/deleteItem?id=${id}`, {
                            method: 'DELETE',
                        });

                        if (!response.ok) {
                            throw new Error(`Failed to delete transaction (HTTP ${response.status})`);
                        }

                        const responseData = await response.json();

                        if (responseData.message === 'Item deleted successfully') {
                            const index = this.originalData.findIndex(item => item.id === id);
                            if (index !== -1) {
                                this.originalData.splice(index, 1);
                                this.filterData();
                            }
                        } else {
                            alert('Failed to delete transaction.');
                        }
                    } else if (this.activeSection === 'Reviews') {
                        const response = await fetch(`/api/admin/deleteReview?id=${id}`, {
                            method: 'DELETE',
                        });

                        if (!response.ok) {
                            throw new Error(`Failed to delete review (HTTP ${response.status})`);
                        }

                        const responseData = await response.json();

                        if (responseData.message === 'Review deleted successfully') {
                            const index = this.originalData.findIndex(item => item.id === id);
                            if (index !== -1) {
                                this.originalData.splice(index, 1);
                                this.filterData();
                            }
                        } else {
                            alert('Failed to delete review.');
                        }
                    }

                } catch (error) {
                    console.error('Error deleting data:', error);
                }
            }
        },
        incrementPage() {
            if (this.currentPage * this.dataPerPage < this.totalData) {
                this.currentPage++;
                this.fetchData();
            }
        },
        decrementPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
                this.fetchData();
            }
        },
        isEmailValid(email) {
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zAZ]{2,4}$/;
            return emailPattern.test(email);
        },
        isPhoneNumberValid(phoneNumber) {
            const phonePattern = /^\+(?:[0-9] ?){6,14}[0-9]$/;
            return phonePattern.test(phoneNumber);
        },
        filterData() {
            if (this.searchQuery === '') {
                this.FilteredData = this.originalData;
            } else if (this.activeSection === 'Users') {
                this.FilteredData = this.originalData.filter((user1) => {
                    return (
                        user1.FirstName.toLowerCase().includes(this.searchQuery) ||
                        user1.LastName.toLowerCase().includes(this.searchQuery) ||
                        user1.Email.toLowerCase().includes(this.searchQuery)
                    );
                });
            } else if (this.activeSection === "Transactions") {
                this.FilteredData = this.originalData.filter((transaction) => {
                    return (
                        transaction.id.toString().includes(this.searchQuery) ||
                        transaction.BuyerID.toString().includes(this.searchQuery) ||
                        transaction.SellerID.toString().includes(this.searchQuery) ||
                        transaction.ItemID.toString().includes(this.searchQuery) ||
                        transaction.TransactionDate.toLowerCase().includes(this.searchQuery) ||
                        transaction.TransactionStatus.toLowerCase().includes(this.searchQuery)
                    );
                });
            } else if (this.activeSection === "Items") {
                this.FilteredData = this.originalData.filter((item) => {
                    return (
                        item.id.toString().includes(this.searchQuery) ||
                        item.SellerID.toString().includes(this.searchQuery) ||
                        item.CategoryID.toString().includes(this.searchQuery) ||
                        item.ItemName.toString().includes(this.searchQuery) ||
                        item.Description.toLowerCase().includes(this.searchQuery) ||
                        item.Location.toLowerCase().includes(this.searchQuery)
                    );
                });
            }
        },
        async submitData(model) {
            if (this.activeSection === 'Users') {
                console.log(this.activeSection);
                const id = document.getElementById('id').value;
                const firstName = document.getElementById('firstName').value;
                const lastName = document.getElementById('lastName').value;
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const phoneNumber = document.getElementById('phoneNumber').value;
                const city = document.getElementById('city').value;
                const street = document.getElementById('street').value;
                const streetNumber = document.getElementById('streetNumber').value;

                if (!this.isEmailValid(email)) {
                    alert('Invalid email address. Please enter a valid email.');
                    return;
                }

                if (!this.isPhoneNumberValid(phoneNumber)) {
                    alert('Invalid phone number. Please enter a valid phone number.');
                    return;
                }
                const queryParams = new URLSearchParams({
                    id,
                    FirstName: firstName,
                    LastName: lastName,
                    Email: email,
                    Password: password,
                    PhoneNumber: phoneNumber,
                    City: city,
                    Street: street,
                    StreetNumber: streetNumber,
                }).toString();

                try {
                    const response = await fetch(`/api/admin/submitUsers?${queryParams}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    });

                    if (!response.ok) {
                        throw new Error(`Failed to submit user data (HTTP ${response.status})`);
                    }

                    const responseData = await response.json();

                    if (responseData.message === 'User data submitted successfully') {
                        // Reload the current page to reflect changes
                        window.location.reload();
                    } else {
                        console.error('Update not successful:', responseData.message);
                    }
                } catch (error) {
                    console.error('Error submitting user data:', error);
                }
            } else if (this.activeSection === 'Transactions') {
                const id = document.getElementById('transactionId').value;
                const BuyerID = document.getElementById('TransactionBuyerId').value;
                const SellerID = document.getElementById('TransactionSellerId').value;
                const ItemID = document.getElementById('TransactionItemId').value;
                const TransactionDate = document.getElementById('transactionDate').value;
                const TransactionStatus = document.getElementById('transactionStatus').value;

                const queryParams = new URLSearchParams({
                    id,
                    BuyerID,
                    SellerID,
                    ItemID,
                    TransactionDate,
                    TransactionStatus,
                }).toString();

                try {
                    const response = await fetch(`/api/admin/submitTransaction?${queryParams}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    });

                    if (!response.ok) {
                        throw new Error(`Failed to submit transaction data (HTTP ${response.status})`);
                    }

                    const responseData = await response.json();

                    if (responseData.message === 'Transaction data submitted successfully') {
                        window.location.reload();
                    } else {
                        console.error('Update not successful:', responseData.message);
                    }
                } catch (error) {
                    console.error('Error submitting transaction data:', error);
                }
            } else if (this.activeSection === 'Items') {
                const itemIdInput = document.getElementById('itemId');
                const itemSellerIdInput = document.getElementById('ItemSellerId');
                const categoryIdInput = document.getElementById('categoryId');
                const itemNameInput = document.getElementById('itemName');
                const descriptionInput = document.getElementById('description');
                const priceInput = document.getElementById('price');
                const conditionInput = document.getElementById('condition');
                const locationInput = document.getElementById('location');
                const uploadDateInput = document.getElementById('uploadDate');
                const createdAtInput = document.getElementById('UserCreatedAt');
                const updatedAtInput = document.getElementById('UserUpdatedAt');
                const queryParams = new URLSearchParams({
                    id: itemIdInput.value,
                    SellerID: itemSellerIdInput.value,
                    CategoryID: categoryIdInput.value,
                    ItemName: itemNameInput.value,
                    Description: descriptionInput.value,
                    Price: priceInput.value,
                    Condition: conditionInput.value,
                    Location: locationInput.value,
                    UploadDate: uploadDateInput.value,
                    created_at: createdAtInput.value,
                    updated_at: updatedAtInput.value
                }).toString();

                try {
                    const response = await fetch(`/api/admin/submitItem?${queryParams}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    });

                    if (!response.ok) {
                        throw new Error(`Failed to submit item data (HTTP ${response.status})`);
                    }

                    const responseData = await response.json();

                    if (responseData.message === 'Item submitted successfully') {
                        window.location.reload();
                    } else {
                        console.error('Update not successful:', responseData.message);
                    }
                } catch (error) {
                    console.error('Error submitting item data:', error);
                }
            } else if (this.activeSection === 'Reviews') {
                const reviewId = document.getElementById('reviewId').value;
                const reviewTransactionId = document.getElementById('reviewTransactionID').value;
                const reviewRate = document.getElementById('reviewRate').value;
                const reviewDescription = document.getElementById('reviewDescription').value;
                const reviewCreatedAt = document.getElementById('reviewCreatedAt').value;
                const reviewUpdatedAt = document.getElementById('reviewUpdatedAt').value;

                const queryParams = new URLSearchParams({
                    id: reviewId,
                    TransactionID: reviewTransactionId,
                    Rate: reviewRate,
                    Description: reviewDescription,
                    created_at: reviewCreatedAt,
                    updated_at: reviewUpdatedAt,
                }).toString();

                try {
                    const response = await fetch(`/api/admin/submitReview?${queryParams}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    });

                    if (!response.ok) {
                        throw new Error(`Failed to submit review data (HTTP ${response.status})`);
                    }

                    const responseData = await response.json();

                    if (responseData.message === 'Review submitted successfully') {
                        window.location.reload();
                    } else {
                        console.error('Update not successful:', responseData.message);
                    }
                } catch (error) {
                    console.error('Error submitting review data:', error);
                }
            }

        },
        async fetchData() {
            this.originalData.length = 0;
            this.FilteredData.length = 0;
            if (this.activeSection === "Users") {
                try {
                    const response = await fetch(`/api/admin/users?page=${this.currentPage}&per_page=${this.dataPerPage}`);
                    if (!response.ok) {
                        throw new Error(`Failed to fetch user data (HTTP ${response.status})`);
                    }

                    const Data = await response.json();
                    if (Data.data.data.length > 0) {
                        console.log('Fetched data:', Data.data.data);
                        this.originalData = Data.data.data;
                        this.FilteredData = Data.data.data;
                        this.totalData = Data.total;
                    } else {
                        console.log('No more data to fetch.');
                    }
                } catch (error) {
                    console.error('Error fetching user data:', error);
                }
            } else if (this.activeSection === "Transactions") {
                try {
                    const response = await fetch(`/api/admin/transactions?page=${this.currentPage}&per_page=${this.dataPerPage}`);
                    if (!response.ok) {
                        throw new Error(`Failed to fetch user data (HTTP ${response.status})`);
                    }

                    const Data = await response.json();
                    if (Data.data.data.length > 0) {
                        console.log('Fetched data:', Data.data.data);
                        this.originalData = Data.data.data;
                        this.FilteredData = Data.data.data;
                        this.totalData = Data.total;
                    } else {
                        console.log ('No more data to fetch.');
                    }
                } catch (error) {
                    console.error('Error fetching user data:', error);
                }
            } else if (this.activeSection === "Items") {
                try {
                    const response = await fetch(`/api/admin/items?page=${this.currentPage}&per_page=${this.dataPerPage}`);
                    if (!response.ok) {
                        throw new Error(`Failed to fetch user data (HTTP ${response.status})`);
                    }

                    const Data = await response.json();
                    if (Data.data.data.length > 0) {
                        console.log('Fetched data:', Data.data.data);
                        this.originalData = Data.data.data;
                        this.FilteredData = Data.data.data;
                        this.totalData = Data.total;
                    } else {
                        console.log ('No more data to fetch.');
                    }
                } catch (error) {
                    console.error('Error fetching user data:', error);
                }
            } else if (this.activeSection === "Reviews") {
                try {
                    const response = await fetch(`/api/admin/reviews?page=${this.currentPage}&per_page=${this.dataPerPage}`);
                    if (!response.ok) {
                        throw new Error(`Failed to fetch user data (HTTP ${response.status})`);
                    }

                    const Data = await response.json();
                    if (Data.data.data.length > 0) {
                        console.log('Fetched data:', Data.data.data);
                        this.originalData = Data.data.data;
                        this.FilteredData = Data.data.data;
                        this.totalData = Data.total;
                    } else {
                        console.log ('No more data to fetch.');
                    }
                } catch (error) {
                    console.error('Error fetching user data:', error);
                }
            }

        },
        editData(model) {
            console.log(model);
            if (this.activeSection === 'Users') {
                document.getElementById('id').value = model.id;
                document.getElementById('firstName').value = model.FirstName;
                document.getElementById('lastName').value = model.LastName;
                document.getElementById('email').value = model.Email;
                document.getElementById('password').value = model.Password;
                document.getElementById('phoneNumber').value = model.PhoneNumber;
                document.getElementById('city').value = model.City;
                document.getElementById('street').value = model.Street;
                document.getElementById('streetNumber').value = model.StreetNumber;
                document.getElementById('UserCreatedAt').value = model.created_at;
                document.getElementById('UserUpdatedAt').value = model.updated_at;
                my_modal_3.showModal();
            } else if (this.activeSection === 'Transactions') {
                document.getElementById('transactionId').value = model.id;
                document.getElementById('TransactionBuyerId').value = model.BuyerID;
                document.getElementById('TransactionSellerId').value = model.SellerID;
                document.getElementById('TransactionItemId').value = model.ItemID;
                document.getElementById('transactionDate').value = model.TransactionDate;
                document.getElementById('transactionStatus').value = model.TransactionStatus;
                document.getElementById('transactionCreatedAt').value = model.created_at;
                document.getElementById('transactionUpdatedAt').value = model.updated_at;
                my_modal_4.showModal();
            }  else if (this.activeSection === 'Items') {
                document.getElementById('itemId').value = model.id;
                document.getElementById('ItemSellerId').value = model.SellerID;
                document.getElementById('categoryId').value = model.CategoryID;
                document.getElementById('itemName').value = model.ItemName;
                document.getElementById('description').value = model.Description;
                document.getElementById('price').value = model.Price;
                document.getElementById('condition').value = model.Condition;
                document.getElementById('location').value = model.Location;
                document.getElementById('uploadDate').value = model.UploadDate;
                document.getElementById('ItemCreatedAt').value = model.created_at;
                document.getElementById('ItemUpdatedAt').value = model.updated_at;
                my_modal_5.showModal();
            } else if (this.activeSection === 'Reviews') {
                document.getElementById('reviewId').value = model.id;
                document.getElementById('reviewTransactionID').value = model.TransactionID;
                document.getElementById('reviewRate').value = model.Rate;
                document.getElementById('reviewDescription').value = model.Description;
                document.getElementById('reviewCreatedAt').value = model.created_at;
                document.getElementById('reviewUpdatedAt').value = model.updated_at;
                my_modal_6.showModal();
            }

            console.log(`Editing ${this.activeSection}:`, model.id);
        },
    };

    window.Alpine = { ...app };
</script>
</html>
