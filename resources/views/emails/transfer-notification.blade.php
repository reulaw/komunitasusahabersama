<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Transfer Dana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .content {
            padding: 20px;
            font-size: 16px;
            color: #333;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            text-decoration: none;
            color: #ffffff;
            background-color: #28a745;
            border-radius: 5px;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header" style="box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);">
            <h2>Pemberitahuan Transfer Dana</h2>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $userName }}</strong></p>
            <p>Kami ingin memberitahukan bahwa sejumlah dana telah ditransfer ke rekening Anda.</p>
            <table style="width:100%; text-align: left; margin-top: 15px;">
                <tr>
                    <td><strong>Jumlah:</strong></td>
                    <td>Rp {{ number_format($amountTransfer,0,',','.') }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal-Waktu:</strong></td>
                    <td>{{ $now }}</td>
                </tr>
                <tr>
                    <td><strong>Rekening Tujuan:</strong></td>
                    <td>{{ $userAccNumber }}</td>
                </tr>
            </table>
            <p>Silakan cek rekening Anda untuk konfirmasi.</p>
        </div>
        <div class="footer">
            <p>Email ini dikirim secara otomatis. Jangan balas email ini.</p>
            <p>&copy; 2025 Komunitas Usaha Bersama. Semua Hak Dilindungi.</p>
        </div>
    </div>
</body>
</html>
