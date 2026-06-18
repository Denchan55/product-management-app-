<h1>商品一覧</h1>

@foreach ($products as $product)
    <div>
        <p>{{ $product->name }}</p>
        <p>{{ $product->price }}円</p>
        <img src="{{ asset('storage/images/' . $product->image_path) }}" width="150">
    </div>
@endforeach