<x-admin-layout>

    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="w-full text-3xl text-black pb-6">Danh sách sản phẩm</h1>

            <div class="w-full mt-12">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Sản phẩm
                </p>
                @can('create', 'App\Models\Product')
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-600 rounded mb-2"
                        onclick="location.href='{{ route('admin.product.create') }}';">Thêm sản phẩm</button>
                @endcan
                @if ($products->isNotEmpty())
                    <div class="w-full bg-white text-left p-4 mb-2">Tìm thấy {{ $products->total() }} sản phẩm</div>
                    <div class="bg-white overflow-auto">
                        <table class="text-left w-full border-collapse">
                            <thead>
                                <tr>
                                    <th
                                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                        Ảnh</th>
                                    <th
                                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                        ID</th>
                                    <th
                                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                        Tên sản phẩm</th>
                                    <th
                                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                        Giá</th>
                                    <th
                                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                        Số lượng</th>
                                    <th
                                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                        Tình trạng</th>
                                    <th
                                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                        Tùy chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="hover:bg-grey-lighter">
                                        <td class="py-1 px-3 border-b border-grey-light">
                                            @if ($product->image == null)
                                                <img class="object-cover rounded-t-lg rounded-lg h-12 w-12 md:rounded-none md:rounded-s-lg"
                                                    src="{{ asset('import/assets/profile-pic-dummy.png') }}"
                                                    alt="">
                                            @else
                                                <img class="object-cover rounded-t-lg rounded-lg h-12 w-12 md:rounded-none md:rounded-s-lg"
                                                    src="{{ asset('storage') . '/' . $product->image }}" alt="">
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 border-b border-grey-light">{{ $product->id }}</td>
                                        <td class="py-4 px-6 border-b border-grey-light">{{ $product->name }}</td>
                                        <td class="py-4 px-6 border-b border-grey-light">{{ $product->price }}</td>
                                        <td class="py-4 px-6 border-b border-grey-light">{{ $product->count }}</td>
                                        <td class="py-4 px-6 border-b border-grey-light">
                                            {{ $product->status === 0 ? 'Còn hàng' : 'Hết hàng' }}
                                        </td>
                                        <td class="py-4 px-6 border-b border-grey-light">
                                            @can('update', $product)
                                                <button
                                                    class="px-4 py-1 text-white font-light tracking-wider bg-green-600 rounded"
                                                    type="button"
                                                    onclick="location.href='{{ route('admin.product.edit', $product->id) }}';">Sửa</button>
                                            @endcan
                                            @can('delete', $product)
                                                <form type="submit" method="POST" style="display: inline"
                                                    action="{{ route('admin.product.destroy', $product->id) }}"
                                                    onsubmit="return confirm('Bạn có chắc?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="px-4 py-1 text-white font-light tracking-wider bg-red-600 rounded"
                                                        type="submit">Xóa</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $products->links() !!}
                @else
                    <div class="w-full bg-red-500 text-left p-4 mb-2 text-white">Không tìm thấy...</div>
                @endif
        </main>
    </div>
</x-admin-layout>
