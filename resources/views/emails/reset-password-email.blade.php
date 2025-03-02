<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        h2 {
            color: #333;
        }
        p {
            color: #666;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password Anda</h2>
        <p>Halo, <strong>{{ $userName }}</strong></p>
        <p>Kami menerima permintaan untuk mengatur ulang kata sandi akun Anda. Klik tombol di bawah ini untuk mereset kata sandi Anda:</p>
        <!-- <a href="{{ $resetUrl }}" class="btn" style="display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; margin-top: 10px;">Reset Password</a> -->
        <a href="{{ $resetUrl }}" class="btn" style="color:white">Reset Password</a>
        <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Komunitas Usaha Bersama</p>
        </div>
    </div>
</body>
</html>
