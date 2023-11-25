<x-blog-layout>
     <!-- Posts Section -->
 <section class="w-full md:w-2/3 flex flex-col items-center px-3">


        <!-- Article -->
        @forelse ($products as $product)
        <article class="flex flex-col shadow my-4">
            <a href="{{ route('product.show', $product->slug ) }}" class="hover:opacity-75">
            <img src="{{ asset("storage/$product->image") }}" width="1000" height="500">
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
                <a href="{{ route('product.show', $product->slug) }} " class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $product->name }}</a>
                <a href="{{ route('product.show', $product->slug ) }}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $product->name }}</a>
                <p href="#" class="text-sm pb-1">
                    By <a href="#" class="font-semibold hover:text-gray-800">{{ $product->name }}</a>, Published on {{ $product->created_at }}
                </p>
                <p class="pb-3">{!! substr($product->content, 0, 100) !!} ...</p>
                {{-- <br /> --}}
                <a href="{{ route('product.show', $product->slug) }}" class="mt-px uppercase text-gray-800 font-bold hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
            </div>
        </article>
        @empty
        <p>
        No Posts has been added
        </p>
        @endforelse

    <!-- Pagination -->
    <div class="flex items-center py-8">

        {{ $products->links() }}

    </div>

</section>
</x-blog-layout>
