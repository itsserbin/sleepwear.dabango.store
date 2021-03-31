$(function () {
    $('.order').click(function() {
        $('body').addClass('lock');
        $('.modal-order').fadeIn(0);
        return false;
    });
    $('.review').click(function() {
        $('body').addClass('lock');
        $('.modal-review').fadeIn(0);
        return false;
    });
    $('.modal-close').click(function() {
        $(this).parents('.modal-fade').fadeOut(0);
        $('body').removeClass('lock');
        $('input[type="text"]').val('');
        return false;
    });
    $(document).keydown(function(e) {
        if (e.keyCode === 27) {
            e.stopPropagation();
            $('.modal-fade').fadeOut(0);
            $('body').removeClass('lock');
            $('input[type="text"]').val('');
        }
    });
    $('.modal-fade').click(function(e) {
        if ($(e.target).closest('.modal').length == 0) {
            $(this).fadeOut(0);
            $('body').removeClass('lock');
            $('input[type="text"]').val('');
        }
    });
});
