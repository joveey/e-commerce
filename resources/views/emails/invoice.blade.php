<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Pembelian</title>
</head>
<body>
    <h2>Halo {{ $user->name }},</h2>
    <p>Berikut adalah invoice dari pembelian kamu di <strong>Verse Beauty</strong>:</p>

    <table width="100%" border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($cart as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td align="center">{{ $item['quantity'] }}</td>
                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item['quantity'] * $item['price'], 0, ',', '.') }}</td>
                </tr>
                @php $total += $item['quantity'] * $item['price']; @endphp
            @endforeach
            <tr>
                <td colspan="3" align="right"><strong>Total</strong></td>
                <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top: 20px;">Terima kasih telah berbelanja di <strong>Verse Beauty</strong>! 😊</p>
</body>
</html>
