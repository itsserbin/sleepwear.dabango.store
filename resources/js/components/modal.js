$(function () {
    $('#order').click(function() {
        $('body').addClass('lock');
        $('#modal-order').addClass('show');
        if ($('#modal-order').hasClass('show')) {
            $('.header').addClass('filter');
            $('.main').addClass('filter');
        }
    });
    $('#review').click(function() {
        $('body').addClass('lock');
        $('#modal-review').addClass('show');
        if ($('#modal-review').hasClass('show')) {
            $('.header').addClass('filter');
            $('.main').addClass('filter');
        }
    });
    $('.modal-close').click(function() {
        $('#modal-order').removeClass('show');
        $('#modal-review').removeClass('show');
        $('body').removeClass('lock');
        $('.header').removeClass('filter');
        $('.main').removeClass('filter');
        $('input').val('');
        $('textarea').val('');
        $('input[name="size"]').prop('checked', false);
    });
    $(document).keydown(function(e) {
        if (e.keyCode === 27) {
            e.stopPropagation();
            $('#modal-order').removeClass('show');
            $('#modal-review').removeClass('show');
            $('body').removeClass('lock');
            $('.header').removeClass('filter');
            $('.main').removeClass('filter');
            $('input').val('');
            $('textarea').val('');
            $('input[name="size"]').prop('checked', false);
        }
    });
    $('.modal').click(function(e) {
        if ($(e.target).closest('.modal-content').length == 0) {
            $('#modal-order').removeClass('show');
            $('#modal-review').removeClass('show');
            $('body').removeClass('lock');
            $('.header').removeClass('filter');
            $('.main').removeClass('filter');
            $('input').val('');
            $('textarea').val('');
            $('input[name="size"]').prop('checked', false);
        }
    });
});