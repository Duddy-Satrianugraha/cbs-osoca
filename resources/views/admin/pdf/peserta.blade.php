<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

@foreach($pesertas->chunk(3) as $group)
    @foreach($group as $currentParticipant)
    <div style="border-top: 1px dashed #CFCFCF; padding: 2px; padding-bottom: -4px; text-align: center; border-bottom: none;">&nbsp;</div>
    <H2 class="title">Daftar Peserta {{ $rotasi->full_name }}</H2>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Npm</th>
                    <th>Station awal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesertas as $index => $participant)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $participant->nama }}</td>
                        <td>{{ $participant->username }}</td>
                        <td>Station {{ $participant->urutan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    @if(!$loop->last)
        <div class="page-break"></div>
    @endif
@endforeach

</body>
</html>
