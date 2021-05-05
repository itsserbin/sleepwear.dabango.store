jQuery(document).ready(function ($) {
    // все формы в .modal-content будут отслылаться по $(this).attr('action')
    $('.modal-content').on('submit', '.form', function (event) {
        event.preventDefault();

        let form = $(this).serializeArray();
        let action = $(this).attr('action');
        let formData = new FormData();

        if (form.length) {
            form.map(function (item) {
                formData.append(item.name, item.value)
            })

            axios.post(action, formData).then(function (response) {
                if (action === window.location.origin + '/send-form') {
                    location.href = window.location.origin + '/send-form';
                }
                if (action === window.location.origin + '/send-review') {
                    alert('Ваш отзыв успешно отправлен на модерацию!')
                }
            })
                .catch(function (response) {
                    alert('Произошла ошибка, пожалуйста, обратитесь по контактным данным.')
                });
            ;
        }

    });
});


$(function () {
    $('#order').click(function () {
        $('body').addClass('lock');
        $('#modal-order').addClass('show');
        if ($('#modal-order').hasClass('show')) {

        }
    });
    $('#review').click(function () {
        $('body').addClass('lock');
        $('#modal-review').addClass('show');
        if ($('#modal-review').hasClass('show')) {
        }
    });
    $('#sizes').click(function () {
        $('body').addClass('lock');
        $('#modal-sizes').addClass('show');
        if ($('#modal-sizes').hasClass('show')) {
        }
    });
    $('.modal-close').click(function () {
        $('#modal-order').removeClass('show');
        $('#modal-review').removeClass('show');
        $('#modal-sizes').removeClass('show');
        $('body').removeClass('lock');
    });
    $(document).keydown(function (e) {
        if (e.keyCode === 27) {
            e.stopPropagation();
            $('#modal-order').removeClass('show');
            $('#modal-review').removeClass('show');
            $('#modal-sizes').removeClass('show');
            $('body').removeClass('lock');
        }
    });
    $('.modal').click(function (e) {
        if ($(e.target).closest('.modal-content').length == 0) {
            $('#modal-order').removeClass('show');
            $('#modal-review').removeClass('show');
            $('#modal-sizes').removeClass('show');
            $('body').removeClass('lock');
        }
    });
});
