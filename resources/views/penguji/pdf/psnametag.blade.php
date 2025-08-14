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
            width: 110mm;
            height: 55mm;
            border: 4px double #000;
            display: table;
            table-layout: fixed;
            box-sizing: border-box;
        }

        .row {
            display: table-row;
        }

        .cell {
            display: table-cell;

            text-align: center;
            padding: 5px;
        }

        .header-cell {
            display: table-cell;
            text-align: left;
            padding: 2px 4px;
            border-bottom: 2px solid #000;
        }

        .left {
            width: 20mm;
            vertical-align: middle;
        }

        .center {
            width: 50mm;
        }

        .right {
            width: 30mm;
            vertical-align: middle;
        }

        .photo {
            width: 80px;
            height: auto;
            max-height: 60mm;
            object-fit: cover;
            border: 1px solid #000;
        }

        .qrcode img {
            width: 100px;
        }

        h3 {
            margin: 5px 0;
            font-size: 14px;
        }

        p {
            margin: 2px 0;
            font-size: 11px;
        }

        .institution-title {
            font-size: 13px;
            font-weight: bold;
        }

        .institution-sub {
            font-size: 10px;
        }

    </style>
</head>
<body>

<div class="page">
    <div class="nametag">
        {{-- Header row --}}
        <div class="row">
            <div class="header-cell" colspan="3">
                <div style="display: table; width: 100%;">
                    <div style="display: table-cell; width: 40px;">
                        <img src="{{ public_path('img/logo-unswa.png') }}" alt="Logo" style="width: 40px;">
                    </div>
                    <div style="display: table-cell; padding-left: 10px; vertical-align: middle;">
                        <div class="institution-title">Fakultas Kedokteran UGJ</div>
                        <div class="institution-sub">Laboratorium Keterampilan Klinik</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content row --}}
        <div class="row">
            {{-- Foto --}}
            <div class="cell left">
                @php
                    $filename = basename($user->avatar);
                    $filepath = public_path('storage/avatar/' . $filename);
                @endphp

                @if(file_exists($filepath))
                    <img class="photo" src="{{ $filepath }}" alt="{{ $filename }}">
                @else
                    <div style="border:1px solid #ccc; height:60mm; display:flex; align-items:center; justify-content:center; font-size:10px;">
                        Tidak ada foto
                    </div>
                @endif
            </div>

            {{-- Data --}}
            <div class="cell center">
                <h2>Kartu Pasien Standar OSCE</h2>
                <h3>{{ $user->name }}</h3>
                <p>{{ $user->email }}</p>
                <p>{{ $user->slug }}</p>

            </div>

            {{-- QR Code --}}
            <div class="cell right qrcode">
                <img src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(200)->generate($user->slug)) }}" alt="QR Code">
            </div>
        </div>
    </div>
</div>

</body>
</html>
