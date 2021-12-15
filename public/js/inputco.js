$(document).ready(function() {
    // event ketika tombol unit 1 di tekan
    $('#unit1').on('click', function() {
        $('#tabel').load('/input_co/tablesatu');
    });

    // event ketika tombol unit 2 di tekan
    $('#unit2').on('click', function() {
        $('#tabel').load('/input_co/tabledua');
    });

    // event ketika tombol common di tekan
    $('#common').on('click', function() {
        $('#tabel').load('/input_co/tablecommon');
    });
});