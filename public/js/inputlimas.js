$(document).ready(function() {
    // event ketika tombol boiler di tekan
    $('#boiler').on('click', function() {
        $('#tabel').load('/input_limas/boiler');
    });

    // event ketika tombol turbin di tekan
    $('#turbin').on('click', function() {
        $('#tabel').load('/input_limas/turbin');
    });

    // event ketika tombol alba di tekan
    $('#alba').on('click', function() {
        $('#tabel').load('/input_limas/alba');
    });
});