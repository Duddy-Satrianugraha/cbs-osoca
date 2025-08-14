@extends('layouts.osce')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb push-down-0">
    <li>{{$ujian->name}}</li>
    <li>{{$sesi->name}}</li>
    <li>{{$lokasi->nama}}</li>
    <li class="active">{{$station->name}}</li>
</ul>
<!-- END BREADCRUMB -->
@endsection

@section('page-title')

@endsection

@section('content')
<div class="page-title">
    <h2>Pemeriksaan Penunjang </h2>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body" style="text-align: center;">

                    <h2> Pemeriksaan Penunjang </h2>
                    <div id="imageContainer" >
                        <img id="stationImage" src="{{asset('storage/'.$template->file_pp)}}" alt="Station Image" class="img-fluid rounded shadow-lg" width="900">
                    </div>


                    <button id="refreshStatusBtn" class="btn btn-primary mb-3">Refresh </button>
                </div>
            </div>
        </div>


</div>
<!-- PAGE CONTENT WRAPPER -->
@endsection

@section('javascript')
<script>
     document.addEventListener("DOMContentLoaded", function () {
        function cekStatusPenunjang() {
            fetch("{{ route('osce.show.penunjang') }}")
                .then(response => {
                        if (!response.ok || response.redirected) {
                            throw new Error("Unauthorized or redirected");
                        }
                        return response.json();
                    })
                .then(data => {
                    const container = document.getElementById('imageContainer');
                    if (data.status === "1") {
                        container.style.display = 'block';
                    } else {
                        container.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error fetching status:', error);
                });
        }

        // Panggil pertama kali saat halaman dimuat
        cekStatusPenunjang();

        // Panggil ulang setiap 3 detik (3000 milidetik)
        setInterval(cekStatusPenunjang, 10000);

        const refreshButton = document.getElementById('refreshStatusBtn');

        refreshButton.addEventListener("click", function () {
            cekStatusPenunjang();
        });
    });
</script>
@endsection
