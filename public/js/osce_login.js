let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

scanner.addListener('scan', function (content) {

    document.getElementById('soal-slug').value = content;
    document.getElementById('form-scan').submit();
});

Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
        scanner.start(cameras[0]);
    } else {
        alert('Kamera tidak ditemukan. Pastikan Anda memberikan izin akses kamera.');
    }
}).catch(function (e) {
    console.error(e);
});
