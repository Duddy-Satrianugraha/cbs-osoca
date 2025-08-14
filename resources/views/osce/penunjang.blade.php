<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <title>{{ config('app.name', 'Arap') }}</title>

  <!-- Bootstrap 3.3.0 -->
  <link rel="stylesheet" type="text/css"  href="{{ asset('css/bootstrap/bootstrap.min.css')}}"/>
  <!-- Font Awesome 4.1.0 -->
  <link rel="stylesheet" type="text/css"  href="{{ asset('css/fontawesome/font-awesome.min.css')}}"/>

  <style>
    body {
      background-color: #f5f5f5;
    }

    .top-bar {
      background-color: #fff;
      border-bottom: 1px solid #ddd;
      padding: 10px 20px;
    }

    .top-bar .logo {
      height: 80px;
    }

    .logout-btn {
      margin-top: 5px;
    }

    .center-title {
      font-size: 18px;
      font-weight: bold;
      text-align: center;
      line-height: 40px;
    }

    .main-card {
      background-color: #fff;
      padding: 30px;
      border: 1px solid #ddd;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      margin-top: 30px;
    }

    .refresh-btn {
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <div class="top-bar clearfix">
    <div class="pull-left">
        <img src="/img/logo.png" alt="Logo Institusi" class="logo" style="height: 40px;">
    </div>

    <div class="pull-left" style="width: 90%; text-align: center;">
        <h4 style="margin: 0; line-height: 40px; font-weight: bold;">OSCE {{$ujian->name}}</h4>
    </div>

    <div class="pull-right" style="margin-top: 5px;">
        <a href="{{route("osce.logout")}}" class="btn btn-danger btn-xs">
            <i class="fa fa-sign-out"></i> Logout
        </a>
    </div>
    </div>

  <!-- ISI -->
  <div class="container">
    <h3 class="text-left" style="margin-top: 30px;">Pemeriksaan Penunjang</h3>

    <div class="main-card text-center">
        <div id="imageContainer" >
            <img id="stationImage" src="{{asset('storage/'.$template->file_pp)}}" alt="Station Image"  width="900">
        </div>
      <button class="btn btn-dark refresh-btn" id="refreshStatusBtn"><i class="fa fa-refresh"></i> Refresh</button>
    </div>
  </div>

  <!-- JS -->
  <script type="text/javascript" src="{{ asset('js/plugins/jquery/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/plugins/bootstrap/bootstrap.min.js') }}"></script>
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
       setInterval(cekStatusPenunjang, 5000);

       const refreshButton = document.getElementById('refreshStatusBtn');

       refreshButton.addEventListener("click", function () {
           cekStatusPenunjang();
       });
   });
</script>
</body>
</html>
