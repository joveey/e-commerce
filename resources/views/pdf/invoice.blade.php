<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .header {
            background: #f2f2f2;
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #ec4899;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #ec4899;
        }
        .content {
            padding: 20px;
        }
        .invoice-info {
            margin-bottom: 20px;
            width: 100%;
        }
        .invoice-info td {
            padding: 5px 0;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .invoice-table th {
            background: #f2f2f2;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .total-row {
            font-weight: bold;
            background-color: #f2f2f2;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Verse Beauty</div>
            <div>Invoice Pembelian</div>
        </div>
        
        <div class="content">
            <h1>Invoice #{{ $order->id }}</h1>
            
            <table class="invoice-info">
                <tr>
                    <td width="50%">
                        <strong>Ditagihkan Kepada:</strong><br>
                        {{ $order->user->name }}<br>
                        {{ $order->user->email }}<br>
                        {{ $order->user->address }}
                    </td>
                    <td width="50%" class="text-right">
                        <strong>Tanggal Pesanan:</strong><br>
                        {{ $order->created_at->format('d F Y') }}<br>
                        <strong>Status:</strong><br>
                        {{ $order->status_label }}
                    </td>
                </tr>
            </table>

            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th class="text-right">Jumlah</th>
                        <th class="text-right">Harga Satuan</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td class="text-right">{{ $item->quantity }}</td>
                            <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3" class="text-right"><strong>Total Pembayaran</strong></td>
                        <td class="text-right"><strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
            
            <p>Terima kasih telah berbelanja di Verse Beauty!</p>
        </div>

        <div class="footer">
            <p>Verse Beauty | Jakarta, Indonesia | hello@versebeauty.com</p>
            <p>Ini adalah invoice yang dibuat secara otomatis.</p>
        </div>
    </div>
</body>
</html>
