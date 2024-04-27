<h1>Sales</h1>
<ul>
    @foreach ($sales as $sale)
        <li>
            <p> {{ $sale->total }} </p>
            <p> {{ $sale->status }} </p>
            @foreach ($sale->products as $product)
                <p>Nombre: {{ $product->name }} color: {{ $product->pivot->color }} size: {{ $product->pivot->size }}</p>
            @endforeach
        </li>
    @endforeach
</ul>
