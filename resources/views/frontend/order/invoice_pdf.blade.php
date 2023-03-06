<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice {{ $transaction->id }}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot td {
            font-weight: bold;
        }

        tfoot tr:last-child {
            border-top: 2px solid #000;
        }
    </style>
</head>

<body>
    <h1>Invoice {{ $transaction->id }}</h1>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            {{-- {{dd($transaction)}} --}}
            @foreach ($transaction->transactionItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->product->price) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->product->price * $item->quantity) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" align="right"><strong>Total:</strong></td>
                <td>{{ number_format($transaction->total_price) }}</td>
            </tr>
            <tr>
                <td colspan="3" align="right"><strong>Shipping Price:</strong></td>
                <td>{{ number_format($transaction->shipping_price) }}</td>
            </tr>
            <tr>
                <td colspan="3" align="right"><strong>Grand Total:</strong></td>
                <td>{{ number_format($transaction->total_price + $transaction->shipping_price) }}</td>
            </tr>
        </tfoot>
    </table>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            {{-- {{dd($transaction)}} --}}
            @foreach ($transaction->transactionItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->product->price) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->product->price * $item->quantity) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" align="right"><strong>Total:</strong></td>
                <td>{{ number_format($transaction->total_price) }}</td>
            </tr>
            <tr>
                <td colspan="3" align="right"><strong>Shipping Price:</strong></td>
                <td>{{ number_format($transaction->shipping_price) }}</td>
            </tr>
            <tr>
                <td colspan="3" align="right"><strong>Grand Total:</strong></td>
                <td>{{ number_format($transaction->total_price + $transaction->shipping_price) }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
