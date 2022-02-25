$(document).ready(function() {
    // event ketika tombol boiler di tekan
    $('#boiler').click(function() {
        $('#tabel').load('/input_limas/boiler');
    });

    // event ketika tombol turbin di tekan
    $('#turbin').click(function() {
        $('#tabel').load('/input_limas/turbin');
    });

    // event ketika tombol alba di tekan
    $('#alba').click(function() {
        $('#tabel').load('/input_limas/alba');
    });
});