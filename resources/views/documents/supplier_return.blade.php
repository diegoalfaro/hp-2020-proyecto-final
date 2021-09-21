<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Devolución a proveedor #{{ $supplierReturn->id }}</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td valign="top">
            <h1>Tecnomecánica Fain</h1>
            <h2>Devolución a proveedor #{{ $supplierReturn->id }}</h2>
        </td>
        <td align="right">
            <h3>Información del proveedor #{{ $supplier->id }}</h3>
            <ul style="list-style-type:none">
                <li>{{ $supplier->business_name }} (CUIT {{ $supplier->cuit }})</li>
                <li>{{ $supplier->address }}</li>
                <li>{{ $supplier->phone }}</li>
            </ul>
        </td>
    </tr>

  </table>

  <br/>

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
                $description = $product->name;
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
        @php
            $total = app('MoneyFormatter')->format($supplierReturn->total);
        @endphp
        <tr>
            <td colspan="3"></td>
            <td align="right">Total $</td>
            <td align="right" class="gray">{{ $total }}</td>
        </tr>
    </tfoot>
  </table>

</body>
</html>