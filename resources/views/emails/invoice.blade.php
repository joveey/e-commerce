<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembelian - Verse Beauty</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        /* Reset styles for email clients */
        body, table, td, p, a, li, blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }
        
        /* Main styles */
        body {
            margin: 0 !important;
            padding: 0 !important;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
        }
        
        .header {
            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 50%, #3b82f6 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }
        
        @keyframes shimmer {
            0%, 100% { transform: translateX(-50%) translateY(-50%) rotate(0deg); }
            50% { transform: translateX(-50%) translateY(-50%) rotate(180deg); }
        }
        
        .logo {
            font-size: 32px;
            font-weight: bold;
            color: white;
            text-decoration: none;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        .invoice-title {
            color: white;
            font-size: 18px;
            margin: 10px 0 0 0;
            position: relative;
            z-index: 2;
            font-weight: 300;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 24px;
            color: #1f2937;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .intro-text {
            color: #6b7280;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.5;
        }
        
        .invoice-info {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid rgba(139, 92, 246, 0.1);
        }
        
        .invoice-meta {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .meta-item {
            flex: 1;
            min-width: 200px;
        }
        
        .meta-label {
            font-size: 12px;
            color: #8b5cf6;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        
        .meta-value {
            font-size: 16px;
            color: #1f2937;
            font-weight: 600;
        }
        
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }
        
        .invoice-table th {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            color: white;
            padding: 18px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .invoice-table td {
            padding: 18px 15px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 15px;
        }
        
        .invoice-table tr:nth-child(even) {
            background: #f9fafb;
        }
        
        .invoice-table tr:hover {
            background: #f3f4f6;
        }
        
        .product-name {
            font-weight: 600;
            color: #1f2937;
        }
        
        .quantity {
            text-align: center;
            font-weight: 600;
            color: #8b5cf6;
        }
        
        .price {
            font-weight: 600;
            color: #059669;
        }
        
        .total-row {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%) !important;
            border-top: 2px solid #8b5cf6;
        }
        
        .total-row td {
            font-weight: bold;
            font-size: 18px;
            color: #1f2937;
            border-bottom: none;
        }
        
        .footer-message {
            background: linear-gradient(135deg, #fef3c7 0%, #fed7aa 100%);
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            margin-bottom: 30px;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }
        
        .footer-message h3 {
            color: #92400e;
            margin: 0 0 10px 0;
            font-size: 20px;
            font-weight: 700;
        }
        
        .footer-message p {
            color: #a16207;
            margin: 0;
            font-size: 16px;
            line-height: 1.5;
        }
        
        .social-links {
            text-align: center;
            padding: 30px;
            background: #f9fafb;
        }
        
        .social-links h4 {
            color: #374151;
            margin-bottom: 15px;
            font-size: 16px;
        }
        
        .social-button {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            transition: transform 0.2s ease;
        }
        
        .social-button:hover {
            transform: translateY(-2px);
        }
        
        .footer {
            background: #1f2937;
            color: #9ca3af;
            text-align: center;
            padding: 30px;
            font-size: 14px;
            line-height: 1.5;
        }
        
        .footer strong {
            color: white;
        }
        
        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                margin: 0 !important;
            }
            
            .header, .content, .social-links, .footer {
                padding: 20px !important;
            }
            
            .invoice-meta {
                flex-direction: column;
            }
            
            .meta-item {
                min-width: auto;
            }
            
            .invoice-table th,
            .invoice-table td {
                padding: 12px 8px;
                font-size: 13px;
            }
            
            .greeting {
                font-size: 20px;
            }
            
            .logo {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">✨ Verse Beauty</div>
            <div class="invoice-title">Invoice Pembelian</div>
        </div>
        
        <!-- Main Content -->
        <div class="content">
            <div class="greeting">Halo {{ $user->name }}! 👋</div>
            <div class="intro-text">
                Terima kasih telah berbelanja di <strong>Verse Beauty</strong>. Berikut adalah detail invoice dari pembelian Anda:
            </div>
            
            <!-- Invoice Information -->
            <div class="invoice-info">
                <div class="invoice-meta">
                    <div class="meta-item">
                        <div class="meta-label">Nomor Invoice</div>
                        <div class="meta-value">#VB-{{ date('Ymd') }}-{{ str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT) }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Tanggal Pembelian</div>
                        <div class="meta-value">{{ date('d F Y, H:i') }} WIB</div>
                    </div>
                </div>
                <div class="invoice-meta">
                    <div class="meta-item">
                        <div class="meta-label">Pelanggan</div>
                        <div class="meta-value">{{ $user->name }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Email</div>
                        <div class="meta-value">{{ $user->email }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Invoice Table -->
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th style="text-align: center;">Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($cart as $item)
                        <tr>
                            <td class="product-name">{{ $item['name'] }}</td>
                            <td class="quantity">{{ $item['quantity'] }}x</td>
                            <td class="price">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td class="price">Rp {{ number_format($item['quantity'] * $item['price'], 0, ',', '.') }}</td>
                        </tr>
                        @php $total += $item['quantity'] * $item['price']; @endphp
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3" style="text-align: right; padding-right: 20px;">
                            <strong>TOTAL PEMBAYARAN</strong>
                        </td>
                        <td style="font-size: 20px; color: #059669;">
                            <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <!-- Footer Message -->
            <div class="footer-message">
                <h3>🎉 Terima Kasih Sudah Berbelanja!</h3>
                <p>
                    Pesanan Anda sedang kami proses dengan penuh perhatian. 
                    Kami akan segera mengirimkan update status pengiriman ke email Anda.
                </p>
            </div>
        </div>
        
        <!-- Social Links -->
        <div class="social-links">
            <h4>Ikuti Kami untuk Update Terbaru</h4>
            <a href="#" class="social-button">📱 Instagram</a>
            <a href="#" class="social-button">🛍️ WhatsApp</a>
            <a href="#" class="social-button">📧 Newsletter</a>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>
                <strong>Verse Beauty</strong><br>
                Your Beauty, Our Passion ✨<br>
                📍 Jakarta, Indonesia | 📞 +62 812-3456-7890<br>
                📧 hello@versebeauty.com | 🌐 www.versebeauty.com
            </p>
            <p style="margin-top: 20px; font-size: 12px; opacity: 0.8;">
                © {{ date('Y') }} Verse Beauty. All rights reserved.<br>
                Email ini dikirim otomatis, mohon jangan dibalas.
            </p>
        </div>
    </div>
</body>
</html>