<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
            margin: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            width: 33.33%;
            border: 1px solid #000;
            padding: 10px;
            vertical-align: top;
            height: 170px;
        }

        .details p {
            margin: 4px 0;
        }

        .qrcode img {
            width: 150px;
            height: 150px;
        }

        .card {
            display: table;
            width: 100%;
        }
        .title {
            text-align: center;
        }
        .left {
            display: table-cell;
            width: 60%;
            text-align: center;
        }

        .right {
            display: table-cell;
            width: 40%;
            text-align: right;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

@foreach($stations->chunk(8) as $chunk)
    <table>
        @foreach($chunk->chunk(2) as $row)
            <tr>
                @foreach($row as $station)
                    <td>
                        <h2 class="title">Kartu Station {{ $station->ujian }}</h2>
                        <div class="card">
                            <div class="left">
                               
                                <h2><strong> Station {{ $station->urutan }} </strong></h3>
                            </div>
                            <div class="right">
                                <div class="qrcode">
                                    <img src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(150)->generate($station->slug)) }}" alt="QR Code">
                                </div>
                            </div>
                        </div>
                    </td>
                @endforeach
                @for($i = $row->count(); $i < 2; $i++)
                    <td></td>
                @endfor
            </tr>
        @endforeach
    </table>
    @if (!$loop->last)
        <div class="page-break"></div>
    @endif
@endforeach
</body>
</html>
