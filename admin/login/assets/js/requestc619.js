"use strict";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/**
 * Set a global error message
 * @type {string}
 */
const ERROR_GLOBAL = "Oops! Something went wrong. Let's try that again";


function bootstrapNotify(message, type)
{
    $.notify({
        message: message
    }, {
        type: type
    });
}


function checkAll(a, b)
{
    $(b + ':visible').prop('checked', $(a).is(':checked')).change();
}


function submitForm(form_id, callback, auto_alert = true)
{
    let form = $(form_id);

    if(form.attr('enctype') === 'multipart/form-data') {

        return submitFormMultipart(form_id, callback, auto_alert);
    }

    let form_data = form.serializeArray();

    let preloader = form.find('.preloader');

    preloader.css('display', 'inline-block');

    // Disable the form submit button
    form.find('button[type=submit]').prop('disabled', true);

    return $.post(form.attr('action'), form_data, result => {

        if(auto_alert) bootstrapNotify(result.message, result.status ? 'success' : 'danger');

        // Additional callback function to run
        if(callback) callback(result, form);

    }, 'json').fail(({responseJSON}) => {

        bootstrapNotify(responseJSON ? responseJSON.message : ERROR_GLOBAL, 'danger');

    }).always(() => {

        // Reset the defaults
        preloader.hide();
        form.find('button[type=submit]').prop('disabled', false);
    });
}


function submitFormMultipart(form_id, callback, auto_alert = true)
{
    let form  = $(form_id);
    let form_data = new FormData(form[0]);

    let preloader = form.find('.preloader');

    preloader.css('display', 'inline-block');

    // Disable the form submit button
    form.find('button[type=submit]').prop('disabled', true);

    return $.ajax({
        url:		form.attr('action'),
        type:		'POST',
        data:		form_data,
        contentType: false,
        processData: false,
        dataType:	'json',
        cache:		false,
        success: result => {

            if(auto_alert) bootstrapNotify(result.message, result.status ? 'success' : 'danger');

            // Additional callback function to run
            if(callback) callback(result, form);
        },
        error: ({responseJSON}) => {

            bootstrapNotify(responseJSON ? responseJSON.message : ERROR_GLOBAL, 'danger');
        },
        complete: () => {

            // Reset the defaults
            preloader.hide();
            form.find('button[type=submit]').prop('disabled', false);
        }
    });
}


function getRequest(url, callback, auto_alert = true)
{
    // If an anchor element object was passed instead, then use the href attribute as target URL.
    url = (typeof(url) === "object") ? $(url).attr('href') : url;

    // Grab the button
    let btn = $('[href="'+url+'"], [data-href="'+url+'"]');

    let preloader = btn.find('.preloader');

    preloader.css('display', 'inline-block');

    // Disable the button
    btn.prop('disabled', true);

    return $.get(url, result => {
        if(auto_alert) bootstrapNotify(result.message, result.status ? 'success' : 'danger');

        // Additional callback function to run
        if(callback) callback(result);

    }, 'json').fail(({responseJSON}) => {

        bootstrapNotify(responseJSON ? responseJSON.message : ERROR_GLOBAL, 'danger');

    }).always(() => {

        // Reset the defaults
        preloader.hide();
        btn.prop('disabled', false);
    });
}



/**
 * A wrapper for common usages
 *
 * Simply add the class to the form you intend to handle submit
 */
$(document).on('submit', '.x-submit', function(e) {
    e.preventDefault();

    let form = this;

    if($(form).data('confirm')) {
        swal({
            title: $(form).data('swal-title') ?? "Are you sure?",
            text: $(form).data('swal-text') ?? "Please confirm you want to proceed with this request...",
            icon: "warning",
            buttons: [true, {
                text: $(form).data('swal-btn') ?? "Yes, proceed",
                closeModal: false,
            }],
            dangerMode: $(form).data('swal-danger') ?? true
        }).then((confirm) => {
            if (confirm) {
                let xhr = callSubmitForm(form).always(() => swal.close());

                // If the user clicked cancel, Let's abort the request...
                $(document).on('click', '.swal-button--cancel', xhr.abort);
            }
        });
    } else {
        callSubmitForm(form);
    }
});

const callSubmitForm = (form) => (
    submitForm(form, function (response, form) {
        // Close any open modals
        $('.modal').modal('hide');

        let then = form.data('then');
        if(then) {
            if(then === 'reload') {
                location.reload();
            } else if(then === 'redirect') {
                location.href = response.data.continue ? response.data.continue : form.data('continue');
            } else if(then === 'alert') {
                swal(response.title, response.message, 'success');
            } else {
                window[then](response, form);
            }
        }
    })
);
