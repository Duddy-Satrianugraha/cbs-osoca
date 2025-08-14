@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.templates.index')}}">daftar template</a></li>
        <li class="active">Template {{ $template->nama_template }}</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Rekamedik Digital   {{ $template->nama_template }}</h2>
</div>
@endsection
@section('content')

<!-- START WIDGETS -->
<div class="row">
                    <!-- START RESPONSIVE TABLES -->
                    <div class="row">
                        <div class="col-md-12">

                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">Template Ujian</h3>

                                </div>
                                <div class="panel-body">
                                    <div class="text-center">
                                        <h2>Laboratorium Keterampilan Klinik Fakultas Kedokteran UGJ</h2>
                                        <h3>{{$template->judul_station}}</h3>
                                        <h4>Rekamedik Digital</h4>
                                    </div>
                                        <table class="table table-bordered ">
                                    <thead>
                                        <tr style="text-align: right;">
                                        <th>Jenis Pemeriksaan</th>
                                        <th>Nama Pemeriksaan</th>
                                        <th>Nilai Default Dewasa</th>
                                        <th>Nilai Default Anak-anak</th>
                                        <th>Nilai Rujukan Dewasa</th>
                                        <th>Nilai Rujukan Anak-anak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Hemoglobin (Hb)</td>
                                        <td>15 g/dL</td>
                                        <td>14 g/dL</td>
                                        <td>13-17 g/dL</td>
                                        <td>11-16 g/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Hematokrit (Ht)</td>
                                        <td>0.38</td>
                                        <td>0.4</td>
                                        <td>39-50%</td>
                                        <td>35-45%</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Eritrosit</td>
                                        <td>5.4 juta/μL</td>
                                        <td>4.9 juta/μL</td>
                                        <td>4.7-6.1 juta/μL</td>
                                        <td>4.1-5.5 juta/μL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Leukosit total</td>
                                        <td>9000 /μL</td>
                                        <td>11000 /μL</td>
                                        <td>4,000-11,000 /μL</td>
                                        <td>5,000-13,000 /μL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Diferensial leukosit</td>
                                        <td>Tergantung jenis sel</td>
                                        <td>Tergantung usia</td>
                                        <td></td>
                                        <td></td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Trombosit</td>
                                        <td>200,000 /μL</td>
                                        <td>250,000 /μL</td>
                                        <td>150,000-400,000 /μL</td>
                                        <td>150,000-450,000 /μL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Laju endap darah (LED)</td>
                                        <td>12 mm/jam</td>
                                        <td>6 mm/jam</td>
                                        <td> <20 mm/jam </td>
                                        <td> <10 mm/jam </td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Retikulosit</td>
                                        <td>1.5 %</td>
                                        <td>2.0 %</td>
                                        <td>0.5-2.5%</td>
                                        <td>1-4%</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Indeks eritrosit (MCV, MCH, MCHC)</td>
                                        <td>87 fL / 30 pg</td>
                                        <td>80 fL / 27 pg</td>
                                        <td>80-100 fL / 27-33 pg</td>
                                        <td>75-95 fL / 25-31 pg</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Morfologi darah tepi</td>
                                        <td>Normal</td>
                                        <td>Normal</td>
                                        <td>Normal</td>
                                        <td>Normal</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Waktu perdarahan (BT)</td>
                                        <td>2 menit</td>
                                        <td>2 menit</td>
                                        <td>1-3 menit</td>
                                        <td>1-4 menit</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Waktu pembekuan (CT)</td>
                                        <td>7 menit</td>
                                        <td>9 menit</td>
                                        <td>5-11 menit</td>
                                        <td>6-10 menit</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Waktu protrombin (PT)</td>
                                        <td>12 detik</td>
                                        <td>13 detik</td>
                                        <td>11-13.5 detik</td>
                                        <td>11-14 detik</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Waktu tromboplastin parsial (APTT)</td>
                                        <td>29 detik</td>
                                        <td>32 detik</td>
                                        <td>25-35 detik</td>
                                        <td>26-40 detik</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>D-dimer</td>
                                        <td>230 ng/mL</td>
                                        <td>230 ng/mL</td>
                                        <td><500 ng/mL</td>
                                        <td><500 ng/mL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Fibrinogen</td>
                                        <td>300 mg/dL</td>
                                        <td>300 mg/dL</td>
                                        <td>200-400 mg/dL</td>
                                        <td>200-400 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Glukosa darah puasa</td>
                                        <td>91 mg/dL</td>
                                        <td>87 mg/dL</td>
                                        <td>70-110 mg/dL</td>
                                        <td>70-110 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Glukosa 2 jam post prandial</td>
                                        <td>125 mg/dL</td>
                                        <td>120 mg/dL</td>
                                        <td><140 mg/dL</td>
                                        <td><140 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>HbA1c</td>
                                        <td>0.037</td>
                                        <td>0.027</td>
                                        <td><5.7%</td>
                                        <td><5.7%</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Kolesterol total</td>
                                        <td>120 mg/dL</td>
                                        <td>110 mg/dL</td>
                                        <td><200 mg/dL</td>
                                        <td><170 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>HDL</td>
                                        <td>60 mg/dL</td>
                                        <td>75 mg/dL</td>
                                        <td>>40 mg/dL</td>
                                        <td>>45 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>LDL</td>
                                        <td>80 mg/dL</td>
                                        <td>50 mg/dL</td>
                                        <td><100 mg/dL</td>
                                        <td><110 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Trigliserida</td>
                                        <td>80 mg/dL</td>
                                        <td>50 mg/dL</td>
                                        <td><150 mg/dL</td>
                                        <td><130 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>SGOT (AST)</td>
                                        <td>20 U/L</td>
                                        <td>15 U/L</td>
                                        <td><40 U/L</td>
                                        <td><35 U/L</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>SGPT (ALT)</td>
                                        <td>21 U/L</td>
                                        <td>15 U/L</td>
                                        <td><41 U/L</td>
                                        <td><35 U/L</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Alkali fosfatase</td>
                                        <td>80 U/L</td>
                                        <td>60 U/L</td>
                                        <td><120 U/L</td>
                                        <td><150 U/L</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>GGT</td>
                                        <td>30 U/L</td>
                                        <td>20 U/L</td>
                                        <td><60 U/L</td>
                                        <td><50 U/L</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Bilirubin total</td>
                                        <td>0.8 mg/dL</td>
                                        <td>0.1 mg/dL</td>
                                        <td><1.2 mg/dL</td>
                                        <td><1 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Bilirubin direct</td>
                                        <td>0.1 mg/dL</td>
                                        <td>0.1 mg/dL</td>
                                        <td><0.3 mg/dL</td>
                                        <td><0.3 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Bilirubin indirect</td>
                                        <td>0.4 mg/dL</td>
                                        <td>0.3 mg/dL</td>
                                        <td><0.9 mg/dL</td>
                                        <td><0.9 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Ureum</td>
                                        <td>30 mg/dL</td>
                                        <td>10 mg/dL</td>
                                        <td>10-50 mg/dL</td>
                                        <td>7-20 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Kreatinin</td>
                                        <td>0.9 mg/dL</td>
                                        <td>0.5 mg/dL</td>
                                        <td>0.6-1.2 mg/dL</td>
                                        <td>0.3-0.7 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Asam urat</td>
                                        <td>5 mg/dL</td>
                                        <td>3 mg/dL</td>
                                        <td>3.5-7 mg/dL</td>
                                        <td>2.5-6 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Natrium (Na)</td>
                                        <td>140 mmol/L</td>
                                        <td>137 mmol/L</td>
                                        <td>135-145 mmol/L</td>
                                        <td>135-145 mmol/L</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Kalium (K)</td>
                                        <td>4 mmol/L</td>
                                        <td>3.7 mmol/L</td>
                                        <td>3.5-5.1 mmol/L</td>
                                        <td>3.4-4.7 mmol/L</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Klorida (Cl)</td>
                                        <td>99 mmol/L</td>
                                        <td>102 mmol/L</td>
                                        <td>96-106 mmol/L</td>
                                        <td>98-106 mmol/L</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Kalsium total</td>
                                        <td>9 mg/dL</td>
                                        <td>9 mg/dL</td>
                                        <td>8.5-10.5 mg/dL</td>
                                        <td>8.8-10.8 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Magnesium</td>
                                        <td>2 mg/dL</td>
                                        <td>2 mg/dL</td>
                                        <td>1.7-2.2 mg/dL</td>
                                        <td>1.7-2.2 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Fosfat</td>
                                        <td>3 mg/dL</td>
                                        <td>3 mg/dL</td>
                                        <td>2.5-4.5 mg/dL</td>
                                        <td>2.5-4.5 mg/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Protein total</td>
                                        <td>7 g/dL</td>
                                        <td>7 g/dL</td>
                                        <td>6.0-8.3 g/dL</td>
                                        <td>6.0-8.0 g/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Albumin</td>
                                        <td>4.0 g/dL</td>
                                        <td>4.1 g/dL</td>
                                        <td>3.5-5.0 g/dL</td>
                                        <td>3.8-4.8 g/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Globulin</td>
                                        <td>2.7 g/dL</td>
                                        <td>2.6 g/dL</td>
                                        <td>2.0-3.5 g/dL</td>
                                        <td>2.0-3.2 g/dL</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Rasio A/G</td>
                                        <td>1.8</td>
                                        <td>1.8</td>
                                        <td>1.2-2.2</td>
                                        <td>1.1-2.0</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>CRP</td>
                                        <td>2 mg/L</td>
                                        <td>2 mg/L</td>
                                        <td><3 mg/L</td>
                                        <td><3 mg/L</td>
                                        </tr>
                                        <tr>
                                        <td>Laboratorium</td>
                                        <td>Laktat dehidrogenase (LDH)</td>
                                        <td>190 U/L</td>
                                        <td>200 U/L</td>
                                        <td>140-280 U/L</td>
                                        <td>150-250 U/L</td>
                                        </tr>
                                    </tbody>
                                    </table>

                                </div>
                                <div class="panel-footer">

                                    <a  class="btn btn-default" href="{{ route('admin.templates.index') }}">Kembali</a>
                                </div>



                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- END RESPONSIVE TABLES -->

</div>
<!-- END WIDGETS -->




@endsection

@section('javascript')

@endsection
