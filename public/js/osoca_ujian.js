let penilaianSementara = {};
let penilaiangr ={};
let penilaianfeedback = "";


toastr.options = {
"closeButton": true,
"progressBar": true,
"positionClass": "toast-top-right",
"timeOut": "2000"
};
// (Opsional) konversi nilai jadi label jika perlu


$(document).on('change', 'input[name="pilihan"]', function () {
let rubrikId = $(this).data('id');
let nilai = $(this).val();

if (!rubrikId) {
    toastr.error('ID rubrik tidak ditemukan.');
    return;
}

penilaianSementara[rubrikId] = nilai;

// ✅ Update isi kolom tabel
$('#nilaiRubrik' + rubrikId).text(nilai);
$('#mnilaiRubrik' + rubrikId).text(nilai);
$('#bobot' + rubrikId).show();
$('#mbobot' + rubrikId).show();

toastr.info('Nilai disimpan di cache.');
$('#modalPenilaian' + rubrikId).modal('hide');
});

function labelNilai(n) {
switch (n) {
    case '4': return 'Superior';
    case '3': return 'Lulus';
    case '2': return 'Borderline';
    case '1': return 'Tidak Lulus';

    default: return n;
}
}

$(document).ready(function () {
$('#FeedbackForm').on('submit', function (e) {
    e.preventDefault(); // 🔥 Cegah submit asli

    let feedback = $(this).find('textarea[name="feedback"]').val();
    let rubrikId = "feedback";
    if (!feedback.trim()) {
        toastr.warning('Feedback tidak boleh kosong.');
        return;
    }
    penilaianfeedback = feedback ;
    // Simpan sementara (misal ke objek)

    $('#feed').text("Terisi");
    $('#feedback').text(feedback);

    toastr.success('Feedback disimpan dicache.');

    // Tutup modal
    $('#modalFeedback').modal('hide');
   // console.log(penilaianSementara);
});
});

$('#submitPenilaianForm').on('submit', function (e) {
    if (!penilaianfeedback.trim()) {
        e.preventDefault();
        toastr.error('Feedback wajib diisi!');
        return false;
    }

    $('#penilaianHiddenInput').val(JSON.stringify(penilaianSementara));
    $('#feedbackHiddenInput').val(penilaianfeedback);
});

