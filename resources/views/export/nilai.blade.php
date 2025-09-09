@php
    // cari jumlah kolom skor maksimum
    $maxSkor = 0;
    foreach ($peserta as $p) {
        $arr = $p->nilai && $p->nilai->skor ? json_decode($p->nilai->skor, true) : [];
        $maxSkor = max($maxSkor, count((array)$arr));
    }
@endphp

<thead>
<tr>
    <th>Nomor</th>
    <th>Nama</th>
    <th>NPM</th>
    <th>soal</th>
    @for ($k = 1; $k <= $maxSkor; $k++)
        <th >Skor {{ $k }}</th>
    @endfor
    <th >Jumlah</th>
    <th >Nilai</th>

</tr>
</thead>
<tbody>
@php $i = 1; @endphp
@foreach ($peserta as $data)
    @php
        $arr = $data->nilai && $data->nilai->skor ? json_decode($data->nilai->skor, true) : ["-","-"];
    @endphp
    <tr>
        <td class="text-center">{{ $i }}</td>

        <td>{{ $data->name }}</td>
        <td>{{ $data->npm }}</td>
        <td>Soal{{ $data->sesi }}</td>
        @foreach ($arr as $key => $value)
            <td>{{ $value ?? '-' }}</td>
        @endforeach

        <td>{{ $data->nilai->jumlah ?? 0 }}</td>
        <td><strong>{{ $data->nilai->nilai ?? 0 }}</strong></td>

    </tr>
    @php $i++; @endphp
@endforeach
</tbody>
