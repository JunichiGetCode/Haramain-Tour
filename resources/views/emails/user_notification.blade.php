<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f5f3ee;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        . { max-width: 1500px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #e5e7eb;
        }
        .header {
            background-color: #0d1130;
            padding: 24px;
            text-align: center;
        }
        .header h1 {
            color: #c9a84c;
            margin: 0;
            font-size: 22px;
            font-weight: 700;
        }
        .content {
            padding: 32px 24px;
        }
        .content p {
            line-height: 1.6;
            margin-bottom: 20px;
            font-size: 15px;
        }
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
        }
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }
        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }
        .alert-warning {
            background-color: #fef3c7;
            color: #92400e;
            border-left: 4px solid #f59e0b;
        }
        .alert-info {
            background-color: #dbeafe;
            color: #1e40af;
            border-left: 4px solid #3b82f6;
        }
        .btn {
            display: inline-block;
            background-color: #c9a84c;
            color: #0d1130;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            margin-top: 10px;
            font-size: 14px;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Haramain Tour</h1>
        </div>
        <div class="content">
            <p>Assalamu'alaikum, <strong>{{ $user->name }}</strong>,</p>

            <div class="alert alert-{{ $tipe }}">
                <strong>{{ $judul }}</strong><br>
                {{ $pesan }}
            </div>

            <p>Untuk melihat detail lebih lanjut mengenai pendaftaran atau merencanakan perjalanan ibadah Anda, silakan cek langsung di dashboard Anda.</p>

            <div style="text-align: center;">
                <a href="{{ route('pendaftaran.riwayat') }}" class="btn">Cek Riwayat Pendaftaran</a>
            </div>
            
            <p style="margin-top: 30px;">
                Terima kasih telah mempercayakan perjalanan ibadah Anda kepada Haramain Tour.<br>
                <em>Wassalamu'alaikum warahmatullahi wabarakatuh.</em>
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} PT Haramain Tour Indonesia. All rights reserved.
        </div>
    </div>
</body>
</html>

