<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{-- @isset($title)
            {{ ucfirst($title) }} -
        @endisset {{ config('app.name') }} --}}
        PD-Mart
    </title>
    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script>
        window.envUrl = "{{ env('APP_URL') }}";
    </script>
</head>

<body class="bg-white font-family-karla">
    @if (Session::has('message'))
        <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
            </svg>
            <p>{{ Session::get('message') }}.</p>
        </div>
    @elseif (Session::has('error'))
        {
        <div class="flex items-center bg-red-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
            </svg>
            <p>{{ Session::get('error') }}.</p>
        </div>
        }
    @endif
    <!-- Top Bar Nav -->
    <nav class="w-full pt-3 bg-blue-800 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

            <nav class='w-full'>
                <div
                    class="flex w-full px-4 items-center justify-between font-bold text-sm text-white uppercase no-underline">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="py-2 px-4 bg-red-500 hover:bg-red-700">Đăng xuất</button>
                        </form>
                        @can('admin-login')
                            <a class="hover:text-gray-200 hover:underline" href="{{ route('admin.index') }}">
                                <button class="py-2 px-4 bg-green-500 hover:bg-green-700">Quản lí</button>
                            </a>
                        @endcan
                    @else
                        <a class="py-2 px-4 mr-2 bg-gray-500 hover:bg-gray-700" href="{{ route('register') }}">Đăng ký</a>
                        <a class="py-2 px-4 bg-green-500 hover:bg-green-700" href="{{ route('login') }}">Đăng nhập</a>
                    @endauth
                </div>
            </nav>
            <div class="flex w-full pt-3 items-center justify-center text-lg no-underline text-white">
                <h1 class="mb-2 text-2xl font-sans tracking-tight text-white dark:text-white">{{$setting->site_name}}</h1>
            </div>
        </div>

    </nav>

    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex w-full flex-col items-center px-1 py-1">
            <form class='w-full'>
                @csrf
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Tìm</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Nhập tên sản phẩm muốn tìm">
                    <button type="button" id="customSubmitButton"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tìm</button>
                </div>
                <span class='text-red-600 product-not-found'>
                </span>
            </form>
            <script>
                document.getElementById('customSubmitButton').addEventListener('click', function(event) {
                    var ulElement = document.querySelector('.product-ul');
                    var messageNotFound = document.querySelector('.product-not-found');
                    messageNotFound.innerText = ''
                    ulElement.innerHTML = '';
                    var inputValue = document.getElementById('default-search').value;
                    event.preventDefault(); // Hủy bỏ hành vi mặc định của nút submit
                    performCustomSearch(inputValue);
                });

                function performCustomSearch(inputValue) {
                    // Thực hiện AJAX POST
                    var url = '/api/products/search';
                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                // Có thể thêm các headers khác nếu cần
                            },
                            body: JSON.stringify({
                                input: inputValue
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            var ulElement = document.querySelector('.product-ul');
                            // Xử lý dữ liệu trả về từ API (data)
                            console.log('Dữ liệu trả về từ API:', data);
                            // Lặp qua mảng dữ liệu từ API và tạo các phần tử li
                            if (data.products.length === 0) {
                                var messageNotFound = document.querySelector('.product-not-found');
                                messageNotFound.innerText = 'Không tìm thấy!';
                            }
                            data.products.forEach(product => {
                                // Tạo phần tử li
                                const liElement = document.createElement('li');
                                liElement.classList.add('h-24', 'w-full', 'mb-1', 'px-1', 'items-center', 'border',
                                    'border-gray-200', 'rounded-lg', 'shadow', 'hover:bg-gray-100',
                                    'dark:border-gray-700', 'dark:bg-gray-800', 'dark:hover:bg-gray-700', 'flex');
                                liElement.style.backgroundColor = '#F9FAFB';
                                // Tạo nội dung của phần tử li
                                var formattedPrice = product.price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
                                liElement.innerHTML = `
                                    <img class="object-cover rounded-t-lg rounded-lg h-20 w-20 md:rounded-none md:rounded-s-lg" src="${origin}/storage/${product.image?product.image:'/images/no-image.jpg'}" alt="">
                                    <div class="flex flex-col justify-between p-1 leading-normal" style='max-width: calc( 100% - 80px )'>
                                    <h5 class="mb-2 text-lg font-sans tracking-tight text-gray-900 dark:text-white custom-card-name" >${product.name}</h5>
                                        <p class="font-sans text-lg text-red-700 dark:text-red-400">Giá: ${formattedPrice}</p>
                                    </div>
                                    `;
                                // Chèn phần tử li vào thẻ ul
                                ulElement.appendChild(liElement);
                            });
                        })
                        .catch(error => {
                            // Xử lý lỗi
                            var messageNotFound = document.querySelector('.product-not-found');
                            messageNotFound.innerText = 'Không tìm thấy!';
                        });
                }
            </script>
            <style>
                .custom-card-name {
                    display: -webkit-box;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    -webkit-line-clamp: 2;
                    /* Number of lines to show */
                    max-height: 3em;
                    /* Adjust the max height as needed */
                }
            </style>
        </div>
    </header>
    <section class='px-1 flex flex-col'>
        <ul class='product-ul block'>
        </ul>
        <div class="w-full flex flex-col align-middle justify-center" style='height: 450px'>
            <div class="w-full h-full flex align-middle justify-center">
                <img class="object-cover rounded-t-lg rounded-lg w-2/3 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                    src="{{ asset('storage') . '/images' . '/qrvietcombank.jpg' }}" alt="">
            </div>
        </div>
    </section>
    <footer class="fixed bottom-0 w-full border-t bg-white pb-3">
        <div class="w-full container mx-auto flex flex-col items-center">
            <div class="uppercase">&copy; {{ $setting->copy_rights }}</div>
        </div>
    </footer>
</body>

</html>
