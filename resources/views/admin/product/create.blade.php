<x-admin-layout>

    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="w-full text-3xl text-black pb-6">Thêm sản phẩm</h1>

            <div class="w-full mt-12">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Thông tin sản phẩm
                </p>
                <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div class="mb-1">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên sản
                                phẩm</label>
                            <input type="text" id="name" value="{{ old('name') }}" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="nhập tên">
                        </div>
                        <div class="mb-1">
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giá</label>
                            <input type="text" id="price" value="{{ old('price') }}" name="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="nhập giá">
                        </div>
                        <div class="mb-1">
                            <label for="count"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Số lượng</label>
                            <input type="text" id="count" value="{{ old('count') }}" name="count"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="nhập số lượng">
                        </div>
                        <div class="mb-1">
                            <label for="status"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Trạng thái</label>
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                id="selectType" name="status">
                                <option value="0" selected>Còn hàng</option>
                                <option value="1">Hết hàng</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mô tả</label>
                            <textarea id="description" name="description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="nhập mô tả">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm text-gray-600" for="message">Ảnh</label>
                            <input type="file" id="myimage" name="image">
                        </div>
                    </div>
                    <button type="submit"
                        class="px-4 py-1 text-white font-light tracking-wider bg-blue-600 rounded">Thêm</button>
                </form>
            </div>
        </main>
    </div>

</x-admin-layout>
