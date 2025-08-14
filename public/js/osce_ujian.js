let penilaianSementara = {};
let penilaiangr ={};
let penilaianfeedback = {};
$(document).ready(function () {
    $('#btnTogglePenunjang').on('click', function () {
        let button = $(this);
        let token = $('meta[name="csrf-token"]').attr('content');

        // Optional: beri efek loading sementara
        button.prop('disabled', true).text('Rendering gambar, sebentar dok...');

        $.ajax({
            url: dataurl,
            method: 'POST',
            data: {
                _token: token
            },
            success: function (response) {
                setTimeout(function () {
                    if (response.status == 1) {
                        button
                            .removeClass('btn-warning')
                            .addClass('btn-success')
                            .text('HASIL PEMERIKSAAN TAMPIL');
                    } else if (response.status == 0) {
                        button
                            .removeClass('btn-success')
                            .addClass('btn-warning')
                            .text('HASIL PEMERIKSAAN TIDAK TAMPIL');
                    } else {
                        alert(response.message || 'Status tidak dikenali');
                    }

                    button.prop('disabled', false); // aktifkan kembali tombol

                }, 4000); // delay 4 detik
            },
            error: function () {
                alert('Terjadi kesalahan saat toggle status penunjang.');
                button.prop('disabled', false).text('Coba Lagi');
            }
        });
    });




});

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

$(document).on('change', 'input[name="rating"]', function () {
let rubrikId = "GlobalRating";
let nilai = $(this).val();

if (!rubrikId) {
    toastr.error('GlabalRating Error.');
    return;
}

penilaiangr[rubrikId] = nilai;

// ✅ Update isi kolom tabel
$('#globalRating').text(labelNilai(nilai));
$('#mglobalRating').text(labelNilai(nilai));

toastr.info('Global Rating disimpan di cache.');
$('#modalGlobalRating').modal('hide');
});


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
    if (!('GlobalRating' in penilaiangr)) {
        e.preventDefault();
        toastr.error('Nilai belum diisi!');
        return false;
    }

    $('#penilaianHiddenInput').val(JSON.stringify(penilaianSementara));
    $('#feedbackHiddenInput').val(penilaianfeedback);
    $('#globalRatingHiddenInput').val(JSON.stringify(penilaiangr));
});

