$(document).ready(function() {
    // $('#btnUsername').on('click', function() {
    //     $('#inputUsername').removeAttr('disabled');
    // });
    $('#btnFullname').on('click', function() {
        $('#inputFullname').removeAttr('disabled');
        $('#saveandreset').append(`<button class="btn btn-success" type="submit">save</button>
        <button class="btn btn-primary" type="reset">reset</button>`);
    });
    // $('#btnBidang').on('click', function() {
    //     $('#inputBidang').removeAttr('disabled');
    // });
    // $('#btnEmail').on('click', function() {
    //     $('#inputEmail').removeAttr('disabled');
    // });
});