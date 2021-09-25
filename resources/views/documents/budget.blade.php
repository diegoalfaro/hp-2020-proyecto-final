<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Presupuesto #{{ $budget->id }}</title>

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
            <h2>Ciente: #{{ $budget->id }}</h2>
        </td>
        <td align="right">
            <h3>Información del cliente #{{ $customer->id }}</h3>
            <ul style="list-style-type:none">
                <li>{{ $customer->fullName }}</li>
                <li>{{ $customer->address }}</li>
                <li>{{ $customer->phone }}</li>
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
            $total = app('MoneyFormatter')->format($budget->total);
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