<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 30px;
        }

        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .kop-img {
            width: 100%;
        }

        .title {
            font-weight: bold;
            text-align: center;
            font-size: 14px;
            padding: 8px;
        }

        .subtitle {
            text-align: center;
            font-size: 12px;
            padding-bottom: 5px;
        }

        .biodata td {
            padding: 4px 8px;
            vertical-align: top;
        }

        .station-title {
            font-weight: bold;
            font-size: 13px;
            background: #eee;
        }

        .feedback td {
            padding: 5px 8px;
            vertical-align: top;
            border: 1px solid #999;
        }
    </style>
</head>
<body>

    {{-- KOP INSTITUSI --}}
    <table>
        <tr>
            <td>
                <img src="{{ public_path('img/Kop_FK.jpg') }}" class="kop-img">
            </td>
        </tr>
    </table>

    {{-- JUDUL UJIAN --}}
    <table>
        <tr>
            <td class="title">Feedback Ujian - {{ $ujian->name }} ta {{ $ujian->ta }}</td>
        </tr>
        <tr>
            <td class="subtitle">PSPK Fakultas Kedokteran UGJ</td>
        </tr>
    </table>

    {{-- BIODATA MAHASISWA --}}
    <table class="biodata">
        <tr>
            <td style="width: 30%;"><strong>Nama Mahasiswa</strong></td>
            <td style="width: 2%;">:</td>
            <td>{{ $ofe->nama }}</td>
        </tr>
        <tr>
            <td><strong>NPM</strong></td>
            <td>:</td>
            <td>{{ $ofe->npm }}</td>
        </tr>
    </table>

    {{-- LOOP STATION FEEDBACK --}}

        <table class="feedback">
            <tr>
                <td colspan="2" class="station-title">Feedback Peserta</td>
            </tr>
            <tr>
                <td style="width: 25%;"><strong>Kelebihan</strong></td>
                <td>{{$feed['kelebihan']}}</td>
            </tr>
            <tr>
                <td><strong>Kekurangan</strong></td>
                <td>{{$feed['kekurangan']}}</td>
            </tr>
            <tr>
                <td><strong>Saran</strong></td>
                <td>{{$feed['saran']}}</td>
            </tr>
        </table>


</body>
</html>
