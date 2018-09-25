$(document).ready(function () {


    //todo поймать все формы с классом formAjax и отправить

    $('.form-ajax').on('submit', function (event) {

        event.preventDefault();

        DudeAjax.callbackResponseFb($(this), '.form-ajax');
    });


    // $('.formAjax').find('input, select, textarea').each(function () {
    //
    //     $data[this.name] = $(this).val();
    // });

});


DudeAjax = {

    callbackResponseFb: function (that, nameForm) {

        var formData = that.serialize();
        var action = that.attr('action');
        var errorClass = nameForm + ' .response_error';
        var okClass = nameForm + ' .response_ok';

        // jQuery(errorClass).html('');
        // jQuery(okClass).html('');

        this.ajaxResponseFb(formData, action, function (response) {

            if (response.error) {

                //todo выводим ошибки

            } else {

                //todo ошибок нет

            }
        });
    },

    ajaxResponseFb: function (data, action, callback) {

        console.log(data, action, callback);

        $.ajax({

            url: action,
            type: 'POST',
            data: data,
            dataType: 'json',

            success: function (response) {

                console.log('ok');
                callback(response);
            },

            error: function (response) {

                console.log('bad');
                console.log(response);
            }
        });
    }


};

