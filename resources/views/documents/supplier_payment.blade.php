<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Pago a proveedor #{{ $supplierPayment->id }}</title>

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
            <h2>Pago a proveedor #{{ $supplierPayment->id }}</h2>
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
        <th align="right">Total</th>
        <th>$ {{ $supplierPayment->amount }}</th>
      </tr>
    </thead>
  </table>

</body>
</html>