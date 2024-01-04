'use strict';

let app = {
    csrfToken: '',
    init: () => {
        app.csrfToken = $('[name=csrf-token]').attr('content');
    },
    loading: {
        show: () => {
            $('html').addClass('overflow-hidden')
            $('.loader').removeClass('d-none')
        },
        hide: () => {
            $('html').removeClass('overflow-hidden')
            $('.loader').addClass('d-none')
        }
    },
    message: {
        info: (msg) => {
            toastr.info(msg, {
                tapToDismiss: true
            });
        },
        success: (msg) => {
            toastr.success(msg, {
                tapToDismiss: true,
                close: true
            });
        },
        error: (msg) => {
            toastr.error(msg, {
                tapToDismiss: true
            });
        }
    }
};

app.init();

$(function () {
    /*======================================================================
    .* CONSTANTS
    .*======================================================================*/

    /*======================================================================
    .* OTHER VARIABLES
    .*======================================================================*/

    /*======================================================================
    .* METHODS
    .*======================================================================*/

    /*======================================================================
    .* DOM EVENTS
    .*======================================================================*/

    $(document).on('click', '[on-click-loading]', function () {
        app.loading.show();
    });

    $(document).on('submit', '[on-submit-loading]', function () {
        app.loading.show();
    });

    $(document).on('click', '#toast-container > .toast', function () {
        $(this).hide();
    });

    $(document).on('click', '#toast-container > .toast a', function (e) {
        e.stopPropagation();
        app.loading.show();
    });
});