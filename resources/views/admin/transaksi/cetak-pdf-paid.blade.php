<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Transaksi Pending</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #e6e6e6;
            color: #333;
            font-weight: bold;
        }

        td:last-child {
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>

<body>
    <h1>Daftar Transaksi</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Produk</th>
                <th>Total Harga</th>
                <th>Ongkir</th>
                <th>Total Bayar</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; $totalBayar = 0; ?>
            @foreach ($transactions as $transaction)
                @if ($transaction->status == 'Selesai' && $transaction->payment == 'settlement')
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $transaction->user->name }}</td>
                        <td>
                            @foreach ($transaction->transactionItems as $item)
                                {{ $item->product->name }}
                            @endforeach
                        </td>
                        <td>{{ number_format($transaction->total_price) }}</td>
                        <td>{{ number_format($transaction->shipping_price) }}</td>
                        <td>{{ number_format($transaction->total_price + $transaction->shipping_price) }}</td>
                        <td>{{ $transaction->status }}</td>
                        <td>{{ $transaction->created_at_formatted }}</td>
                        <td>{{ $transaction->payment == 'settlement' ? 'Dibayar' : '' }}</td>
                    </tr>
                    <?php $totalBayar += $transaction->total_price + $transaction->shipping_price; ?>
                @endif
            @endforeach
            <tr>
                <td colspan="5" style="text-align: right;"><strong>Total Bayar:</strong></td>
                <td colspan="4" style="text-align: left;"><strong>{{ number_format($totalBayar) }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
