<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 210mm;
            height: 297mm;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .nametag {
            width: 75mm;
            height: 110mm;
            border: 4px double #000; /* <— garis ganda */
            box-sizing: border-box;
            padding: 10px;
            text-align: center;
        }

        .header {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .photo {
            display: block;
            width: 150px;
            height: auto;
            margin: 10px auto;
            object-fit: cover;
            border: 1px solid #000;
        }

        .qrcode img {
            width: 125px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <div class="page">
        <div class="nametag">
            {{-- Logo dan Nama Institusi --}}
            <div class="header">
                <img src="{{ public_path('img/logo-unswa.png') }}" alt="Logo" style="width:40px; float: left;">
                <span style="font-size: 18px;">Fakutas Kedokteran UGJ</h3><br>
                <span style="font-size: 14px;">Laboratorium Keterampilan Klink</span>
            </div>
            @php
            // Ambil hanya nama file dari URL
            $filename = basename($user->avatar);

            // Buat full path ke file lokal
            $filepath = public_path('storage/avatar/' . $filename);
            @endphp

            {{-- QR code --}}
            <div class="qrcode">
                <img src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(300)->generate($user->slug)) }}" alt="QR Code">
            </div>

            {{-- Identitas --}}
            <h3 style="margin: 5px 0;">{{ $user->name }}</h3>
            <p style="margin: 2px 0;">NPM: {{ $user->username }}</p>

            {{-- Foto peserta --}}
            @if ($user->avatar)
                <img class="photo" src="{{  $filepath }}" alt="{{ $filename }}" style="width:120px; height:180px;">
            @endif


        </div>
    </div>
</body>
</html>
