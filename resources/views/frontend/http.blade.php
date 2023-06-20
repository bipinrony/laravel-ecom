<ul>
    @foreach ($products as $product)
        {{-- <li>{{ $product->title }}</li> --}}
        <li>{{ $product['title'] }}</li>
    @endforeach
</ul>

{{ $laravel }}
