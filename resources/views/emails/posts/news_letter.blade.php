<x-mail::message>
# Introduction

Lists of latest products published since 7 days

<ul>
    @foreach ($products as $product)
        <li><a href="{{ route('product.show', $product->slug) }}">{{ $product->title }}</a></li>
    @endforeach
</ul>
<p>Click on the links to read the full products.</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
