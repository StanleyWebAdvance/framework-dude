jQuery(document).ready(function () {


    //todo поймать все формы с классом formAjax и отправить

    // jQuery('.modal-form').on('submit', function (event) {
    //
    //     event.preventDefault();
    //
    //     ObjectPlazaJs.callbackResponseFb(jQuery(this), '.modal-form');
    // });


    $('.formAjax').find('input, select, textarea').each(function () {

        $data[this.name] = $(this).val();
    });

});


ObjectPlazaJs = {

    callbackResponseFb: function (that, nameForm) {

        var formData = that.serialize();
        var action = that.attr('action');
        var errorClass = nameForm + ' .response_error';
        var okClass = nameForm + ' .response_ok';

        jQuery(errorClass).html('');
        jQuery(okClass).html('');

        this.ajaxResponseFb(formData, action, function (response) {

            if (response.error) {

                //todo выводим ошибки

            } else {

                //todo ошибок нет

            }
        });
    },

    ajaxResponseFb: function (data, action, callback) {

        jQuery.ajax({

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

