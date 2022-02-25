// $(document).ready(function(){

    const flashDataWarning = $('.flash-data-warning').data('flashdata');
    const flashDataSuccess = $('.flash-data-success').data('flashdata');

    if (flashDataWarning) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: flashDataWarning
        });
    };

    if (flashDataSuccess) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: flashDataSuccess
        });
    };

    $('.fHapus').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus permanen data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).submit();
            }
        });
    });
// });