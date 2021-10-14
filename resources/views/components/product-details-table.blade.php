<table width="100%">
    <thead style="background-color: lightgray;">
        <tr>
            <th>#</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio Unitario $</th>
            <th>Subtotal $</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            @php
                $id = $product->id;
                $brand = $product->product_brand->name;
                $name = $product->name;
                $description = "$brand | $name";
                $quantity = $product->detail->quantity;
                $unit_price = app('MoneyFormatter')->format($product->detail->list_price);
                $subtotal = app('MoneyFormatter')->format($product->detail->subtotal);
            @endphp
            <tr>
                <th scope="row">{{ $id }}</th>
                <td>{{ $description }}</td>
                <td align="right">{{ $quantity }}</td>
                <td align="right">{{ $unit_price }}</td>
                <td align="right">{{ $subtotal }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        @foreach ($footerLines as $line)
            @php
                $price = app('MoneyFormatter')->format($line->price);
            @endphp
            <tr>
                <td colspan="3"></td>
                <td align="right">{{$line->text}}</td>
                <td align="right" class="gray">{{ $price }}</td>
            </tr>
        @endforeach
    </tfoot>
</table>