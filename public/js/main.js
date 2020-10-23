$(document).ready(function() {

    $('.modal').on('shown.bs.modal', function() {
        $('input.autofocus').trigger('focus');
     });
});
