let scanner = null;

function startScanner(targetVideoId, inputId, formId) {
    // Hentikan scanner jika sedang aktif
    if (scanner) {
        scanner.stop().then(() => {
            scanner = null;
            initializeScanner(targetVideoId, inputId, formId);
        }).catch((e) => {
            console.error('Gagal stop scanner:', e);
            scanner = null;
            initializeScanner(targetVideoId, inputId, formId);
        });
    } else {
        initializeScanner(targetVideoId, inputId, formId);
    }
}

function initializeScanner(videoId, inputId, formId) {
    const videoElement = document.getElementById(videoId);
    const inputElement = document.getElementById(inputId);
    const formElement = document.getElementById(formId);

    if (!videoElement || !inputElement || !formElement) {
        console.warn('Elemen tidak lengkap:', videoId, inputId, formId);
        return;
    }

    scanner = new Instascan.Scanner({ video: videoElement });

    scanner.addListener('scan', function (content) {
        inputElement.value = content;
        formElement.submit();
    });

    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            alert('Kamera tidak ditemukan. Pastikan Anda memberikan izin akses kamera.');
        }
    }).catch(function (e) {
        console.error('Gagal mendapatkan kamera:', e);
    });
}

$(document).ready(function () {
    // Saat halaman pertama kali dimuat, aktifkan scanner soal
    startScanner('preview', 'soal-slug', 'form-scan');

    // Saat modal pasien dibuka, aktifkan scanner pasien
    $('#modalPasien').on('shown.bs.modal', function () {
        startScanner('mpreview', 'pasien-slug', 'form-scanx');
    });

    // Saat modal pasien ditutup, aktifkan kembali scanner soal
    $('#modalPasien').on('hidden.bs.modal', function () {
        startScanner('preview', 'soal-slug', 'form-scan');
    });
});
