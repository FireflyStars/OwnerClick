// import Sortable from "sortablejs";
// import PerfectScrollbar from 'perfect-scrollbar';
import "moment/locale/tr" ;
import intlTelInput from 'intl-tel-input';
import 'intl-tel-input/build/css/intlTelInput.css';
import 'intl-tel-input/build/js/utils';
import Lang from 'lang.js';
import languages from './language';
window.lang = new Lang({ languages })


if (localStorage.getItem('user')) {
    window.user = JSON.parse(localStorage.getItem('user'));
} else {
    $.getJSON("profile/public-data", function (data) {
        localStorage.setItem('user', JSON.stringify(data));
        window.user = data;
    });
}

var calendar = null;

// core version + navigation, pagination modules:
import Swiper, {Navigation, Pagination} from 'swiper';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import {execute} from "bootstrap/js/src/util";

// configure Swiper to use modules
Swiper.use([Navigation, Pagination]);

// init Swiper:


// .ajax-selectpicker classına sahip olanları ajax isteği gönderir data-select-url olan

window.reloadSelectPicker = function () {
    if ($(this).attr('data-select-url') != undefined) {
        $.getJSON($(this).attr('data-select-url'), function (data) {
            $(this).html('');
            for (var i = 0; i < data.length; i++) {
                let option = document.createElement('option');
                option.innerText = data[i].name;
                option.value = data[i].id;
                if (option.value !== "" && $(this).attr('data-old-value') === option.value) {
                    option.setAttribute('selected', 'selected')
                }

                this.append(option)
            }
            $(this).selectpicker('refresh');
            $(this).trigger('changed.bs.select')

            //    if($(this).attr('data-select-triger-target') !== ''){
            //        $(document.getElementById($(this).attr('data-select-triger-target'))).trigger('change')
            //    }
        }.bind(this))
    }
}

$('.ajax-selectpicker').each(function () {
    reloadSelectPicker.call(this);
})

window.reloadInputMask = function () {
    if ($("[name=authorized_person_phone]").length > 0) {
        const phone_number = document.getElementsByName("authorized_person_phone")[0];
        window.phoneNumberPhoneTelInput = intlTelInput(phone_number, {
            // nationalMode: true,
            separateDialCode: true,
            initialCountry: user.locationIso2
            // autoPlaceholder : 'polite',
            // hiddenInput:'full'
            // any initialisation options go here
        });
        // window.setInputFilter(phone_number, function(value) {
        //     return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
        // });

    }
}

window.prepareInputFromTelInput = function () {
    if ($("[name=authorized_person_phone]").length > 0) {
        var phone_number = phoneNumberPhoneTelInput.getNumber(intlTelInputUtils.numberFormat.E164);
        $("[name=authorized_person_phone]").val(phone_number);
    }

}

window.setFormValidation = function (id) {
    console.log('setFormValidation',id)
    window.$validation = $(id).validate({
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
            $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function (element) {
            $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
            $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement: function (error, element) {
            $(element).closest('.form-group').append(error);
        },
    });
}

window.submitForm = function (redirect, target, href, modalID, closeModal) {
    $(this).on('submit', function (e) {
        e.preventDefault()

        //Tıklanan submit buttonunu disable etme
        let letFormSubmitButton = $(this).find('[type="submit"]');
        letFormSubmitButton.prop('disabled', true)
        letFormSubmitButton.attr('data-text-temp', letFormSubmitButton.text());
        letFormSubmitButton.text(lang.get('dashboard.loading') + '...');

        window.prepareInputFromTelInput();


        let data = $(this).serializeArray();
        var frm = $(this);
        var formData = new FormData(frm[0]);
        if ($('input[type=file]').length > 0) {
            formData.append('file', $('input[type=file]')[0].files[0])
        }
        console.log('modal form', formData, $(this).attr('method'), $(this).attr('action'))
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            processData: false,
            contentType: false,
            dataType: "json",
            data: formData,
            success: function (data) {
                console.log('modal form ajax')
                letFormSubmitButton.prop('disabled', false)
                letFormSubmitButton.text(letFormSubmitButton.attr('data-text-temp'));
                //Eğer takvim varsa takvimdeki eventları güncelle
                if (document.getElementById('calendar')) {
                    window.calendarItem.refetchEvents()
                }

                $.notify({
                    icon: "check",
                    title: "<b" + data.message.title + "</b>",
                    message: data.message.text
                }, {
                    type: "success",
                    icon_type: 'class',
                    timer: 1000,
                    placement: {
                        from: "bottom",
                        align: "right"
                    }
                });

                // Swal.fire(data.message.title, data.message.text, data.message.type).then(function (ok) {
                if (redirect === 'true') {

                    if (target == null && data.target != null) {
                        target = data.target;
                    }

                    if (href == null && data.href != null) {
                        href = data.href;
                    }
                    target = target.split(",");
                    href = href.split(",");

                    for (let i = 0; i < target.length; i++) {
                        getAjax(null, target[i], href[i], false, 'true')
                    }
                    $(modalID).modal('hide')
                } else if (redirect === 'reload') {

                    getAjax(null, data.reload_target, data.reload_url, false, 'true')

                } else {
                    if (typeof data.data !== "undefined") {
                        selectPickerAddOption(redirect, data.data.id, data.data.name, true);
                    }
                    if (closeModal === true) {
                        $(modalID).modal('hide')
                    }
                }
                // })
            },
            error: function (xhr, b, c, d, e, f) {
                console.log('modal form ajax error')

                letFormSubmitButton.prop('disabled', false)
                letFormSubmitButton.text(letFormSubmitButton.attr('data-text-temp'));

                if (xhr.status === 200) {
                }
                if (xhr.status == 302) {
                    // location.href = xhr.getResponseHeader("Location");
                }
                for (let errorKey in xhr.responseJSON.errors) {

                    $(modalID).find('label[for="' + errorKey + '"]').text(xhr.responseJSON.errors[errorKey])
                    $(modalID).find('label[for="' + errorKey + '"]').parent().addClass('has-error')
                    $(modalID).find('label[for="' + errorKey + '"]').parent().removeClass('has-success')

                }

            },
        });
    })
}

window.modalInitalize = function (modalID, redirect, href = null, target = null, closeModal = true) {
    //eval(document.querySelector('.modal .modal-content script'));
    // modalInit();
    window.setFormValidation(modalID)
    console.log('modalInitalize');
    $(modalID + ' .datasource').each(function () {
        getAjax(null, "#" + $(this).attr('id'), $(this).attr('data-source'), false, false, false, false);
    })


    if ($(modalID).parent('.modal').length > 0) {
        modalID = "#" + $(modalID).parent('.modal').attr('id')
    }
    // const container = document.querySelector('.property-unit-list');
    // const ps = new PerfectScrollbar(container);

    reloadSwipeUnitDetail.call();
    $(modalID + ' .selectpicker').selectpicker()
    $(modalID + ' .ajax-selectpicker').each(function () {
        reloadSelectPicker.call(this);
    })

    window.reloadInputMask()

    // window.changePermission()

    $(modalID + ' #calendar').each(function () {
        reloadCalendar.call(this);
    })


    $(modalID + ' .sortable').each(function () {
        reloadSortable.call(this);
    })

    $(modalID + ' #input-pd').each(function () {
        if ($(this).attr('data-type_id')) {
            window.fileinputs.render(modalID, this)
        } else {
            window.fileinputs.folderListener(modalID, this)
        }
    })

    reloadDropdownMenuPosition.call($('.content'));

    $(modalID + ' form').each(function () {
        window.submitForm.call(this, redirect, target, href, modalID, closeModal);
    })

    $('.swal2-container form').each(function () {
        window.submitForm.call(this, redirect, target, href, modalID, closeModal);
    })

}

function errorNotify(data) {
    let JSONMessage;
    if (data.status === 401) {
        window.location.reload();
    }
    if (typeof data.responseJSON.message == "undefined") {
        JSONMessage = lang.get('dashboard.error_occurred_try_again');
    } else {
        JSONMessage = data.responseJSON.message;
    }
        Swal.fire({
        title: JSONMessage,
        toast: true,
        timer: 4000,
            icon: 'error',
            timerProgressBar: true,
        didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    },
        showConfirmButton: false,
        // customClass: {
        // confirmButton: 'defaultButton'
    // },
        // confirmButtonText: '<div><i class="fa pr-1 fa-thumbs-up"></i>'+lang.get('dashboard.okey')+'</div>',
        position: 'top-right'
    })
}

window.getAjax = function (clickButtonElement, targetElementName, targetHrefName, isBackState = false, redirect = false, closeModal = false, initialize = true) {
    if($(targetElementName).length == 0){
        return
    }
    if ($(clickButtonElement).text() !== null && isBackState !== false) {
        document.title = $(clickButtonElement).find('p,span').text()
    }
    let clickButton = clickButtonElement
    $(clickButton).parent().parent().find('.active').removeClass('active');
    $(clickButton).parent().addClass('active')
    let targetElement = targetElementName;
    if ($(targetElement + ">.card").length > 0) {
        $(targetElement + ">.card").prepend(loading());

    } else {
        $(targetElement).html(loading());
    }
    $.ajax({
        type: "get",
        url: targetHrefName,
        success: function (data) {

            if ($(clickButton).attr('data-redirect-target') != null && $(clickButton).attr('data-redirect-href') != null) {
                let targets = $(clickButton).attr('data-redirect-target').split(",");
                let hrefs = $(clickButton).attr('data-redirect-href').split(",");
                for (let i = 0; i < targets.length; i++) {
                    getAjax(null, targets[i], hrefs[i], isBackState, redirect, closeModal, initialize);
                }


            } else {
                $(this).parent().addClass('active')
                $(targetElement).html(data);
                if (initialize) {
                    modalInitalize(targetElementName, redirect, null, null, closeModal)

                    if ($('#bottom-navigation').length > 0) {
                        if ($('#unitMenu h4').length > 0) {
                            $('#mobile-header #mobile-header-title').html($('#unitMenu h4').html());
                            $('#mobile-header #mobile-header-logo').hide();
                            $('#mobile-header #mobile-header-title').show();

                        } else {
                            $('#mobile-header #mobile-header-title').hide();
                            $('#mobile-header #mobile-header-logo').show();
                        }
                    }
                }
            }
        },
        error: function (data) {
            errorNotify(data);
        }

    })
    if (isBackState) {
        window.history.pushState({
            href: targetHrefName,
            target: targetElement
        }, "Deneme", targetHrefName);
    } else {
        // window.history.replaceState({
        //     href: targetHrefName,
        //     target: targetElement
        // }, "Deneme", targetHrefName);

    }
}

var tempModal = [];

$(document).ready(function () {
     moment.locale(user.locationIso2)
     window.lang.setLocale(user.locationIso2)
    window.lang.setMessages(languages)
    window.addEventListener("hashchange", function (e) {
        if (e.oldURL.length > e.newURL.length)
            alert("backa")
    });

    setFormValidation('#RegisterValidation');
    setFormValidation('#TypeValidation');
    setFormValidation('#LoginValidation');
    setFormValidation('#RangeValidation');


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '[data-target]', function () {

        if ($(this).attr('data-toggle') == 'modal') {

            let modalButton = $($(this).attr('data-target'));
            if (modalButton.length === 0) {
                createModal($(this).attr('data-target'))
                $(this).trigger('click')

            } else {
                tempModal.push($($(this).attr('data-target')));
                if (tempModal.length > 1) {
                    // tempModal.push($($(this).attr('data-target')));
                    tempModal.unshift(tempModal[tempModal.length - 2]);
                    tempModal[0].modal('hide');
                }
            }
        }
    })




    $(document).on('click', '[data-toggle="ajax"]', function (e) {
        let isBackState = true;
        e.preventDefault();
        if ($(this).attr("data-push-history") === "false") {
            isBackState = false
        }
        getAjax(this, $(this).attr('data-target'), $(this).attr('data-href'), isBackState, false, false);

    })



    window.onpopstate = function (event) {
        if (event.state != null) {
            getAjax(this, event.state.target, event.state.href, true);
        } else {
            window.history.back();
        }
    }


    $(document).on('shown.bs.modal', '.modal', function (e) {
        let loadingItem = $('<div class="modal-content text-center"><div class="modal-body text-center" ></div></div>')
        $($(e.relatedTarget).attr('data-target')).find('.modal-dialog').html(loadingItem.append(loading()));
        /*
                $($(e.relatedTarget).attr('data-target')).find('.modal-dialog').html("Yukleniyor")
        */
        $(document).ajaxComplete(function (e, xhr, settings) {
            if (xhr.status === 302) {
                window.location.reload();
            }
        });
        if ($(e.relatedTarget).attr('data-href') != null) {
            $.ajax($(e.relatedTarget).attr('data-href')).then(function (a) {
                if (typeof a.success !== "undefined" && a.success === false) {
                    $(e.currentTarget).modal('hide');

                    Swal.fire({
                        title: a.title,
                        text: a.message,
                        html: a.html,
                        toast: a.toast,
                        showCloseButton: a.showCloseButton,
                        showConfirmButton: a.showConfirmButton,
                        timer: a.timer,
                        icon: a.icon,
                        timerProgressBar: true,
                        backdrop: a.backdrop,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        },
                        position: a.position
                    })
                }
                $($(e.relatedTarget).attr('data-target')).find('.modal-dialog').html(a)
                modalInitalize($(e.relatedTarget).attr('data-target'), $(e.relatedTarget).attr('data-redirect'), $(e.relatedTarget).attr('data-redirect-href'), $(e.relatedTarget).attr('data-redirect-target'));
            }).fail(function (b){
                $(e.currentTarget).modal('hide')
                errorNotify(b)
            })
        }
    });

    $(document).on('hidden.bs.modal', '.modal', function (e) {
        if (tempModal.length > 1) {
            tempModal.pop().modal('show');
        } else {
            tempModal.shift();
        }

    })

    $(document).on('click', '.btn-delete-confirm', function (e) {
        e.preventDefault();
        deleteConfirm($(this).attr('data-text'), $(this).attr('data-href'), $(this).attr('data-redirect'), $(this).attr('data-redirect-href'), $(this).attr('data-redirect-target'), $(this).attr('data-modal-id'), $(this).attr('data-redirect-run-command'),$(this).attr('id'))

    })

    $(document).on('click', '.btn-cancel-confirm', function (e) {
        e.preventDefault();
        cancelConfirm($(this).attr('data-text'), $(this).attr('data-href'), $(this).attr('data-redirect'), $(this).attr('data-redirect-href'), $(this).attr('data-redirect-target'),$(this).attr('id'))

    })

    reloadDropdownMenuPosition.call($('.content'));

    $(document).on('click', '.showMoreText', function (e) {
        reloadShowMoreText.call($(this));
    });

    $(' .datasource').each(function () {
        getAjax(null, "#" + $(this).attr('id'), $(this).attr('data-source'), false, false, false, false);
    })

    // BU kısım ödeme ile ilgili değişiklikler yapıldığında grafiğin tekrardan yüklenmesi için tasarlanmıştır.
    $(document).ajaxComplete(function (e, xhr, settings) {
        console.log('ASD');
        if((settings.type === 'DELETE' || settings.type === 'POST') && settings.url.includes('payment')){
            if(window.yearlyPaymentChart){
                dashboard.initialize();
            }
        }
    });

})


window.getParameterByName = function (name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}


window.createModal = function (id) {
    var modal = '';
    modal += '<div class="modal" id="' + id.substring(1) + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">'
    modal += '<div class="modal-dialog modal-lg" role="document">'
    modal += '<div class="modal-content">'
    modal += '<div class="modal-header">'
    modal += '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
    modal += '<h4 class="modal-title" id="myModalLabel">Modal title</h4>'
    modal += '</div>'
    modal += '<div class="modal-body">'
    modal += '</div>'
    modal += '<div class="modal-footer">'
    modal += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
    modal += '<button type="button" class="btn btn-primary">Save changes</button>'
    modal += '</div>'
    modal += '</div>'
    modal += '</div>'
    modal += '</div>'
    $('body').append($(modal));
}

window.deleteConfirm = function (text, link, redirect = false, href = null, target = null, modalID = null, runCommand = null,className = null) {
    Swal.fire({
        title: lang.get('dashboard.are_you_sure_delete'),
        text: text,
        icon: "warning",
        showConfirmButton: true,
        customClass: {
            confirmButton: className,
        },
        showCancelButton:true,
        confirmButtonText: lang.get('dashboard.yes_i_am_sure'),
        dangerMode: true,
    }).then(function (result) {
        if (result.isConfirmed) {
            $.ajax({url: link, method: 'DELETE'})
                .then(function (data) {
                    if (typeof data.success !== "undefined" && data.success === false) {
                        $.notify({
                            icon: data.icon,
                            title: "<b" + data.title + "</b>",
                            message: data.message
                        }, {
                            type: data.type,
                            icon_type: 'class',
                            timer: 1000,
                            placement: {
                                from: "bottom",
                                align: "right"
                            }
                        })
                    } else {
                        $.notify({
                            icon: "restore_from_trash",
                            title: "<b>"+lang.get('dashboard.congratulations')+"</b>",
                            message: lang.get('dashboard.item_remove_success',{item:text})
                        }, {
                            type: "success",
                            icon_type: 'class',
                            timer: 1000,
                            placement: {
                                from: "bottom",
                                align: "right"
                            }
                        });
                    }
                    if (target != null) {
                        target = target.split(",");
                        href = href.split(",");
                        for (let i = 0; i < target.length; i++) {
                            getAjax(null, target[i], href[i], false)
                        }
                    }
                    $(modalID).modal('hide')
                    eval(runCommand)
                });

        }
    })
}

window.cancelConfirm = function (text, link, redirect = false, href = null, target = null,className = null) {
    Swal.fire({
        title: lang.get('dashboard.are_you_sure_cancel'),
        text: text,
        icon: "warning",
        showConfirmButton: true,
        customClass: {
            confirmButton: className,
        },
        showCancelButton:true,
        confirmButtonText: lang.get('dashboard.yes_i_am_sure'),
        dangerMode: true,
    }).then(function (result) {
        if (result.isConfirmed) {
            $.ajax({url: link, method: 'PUT'})
                .then(function (data) {
                    if (typeof data.success !== "undefined" && data.success === false) {
                        $.notify({
                            icon: data.icon,
                            title: "<b" + data.title + "</b>",
                            message: data.message
                        }, {
                            type: data.type,
                            icon_type: 'class',
                            timer: 1000,
                            placement: {
                                from: "bottom",
                                align: "right"
                            }
                        })
                    } else {
                        $.notify({
                            icon: "restore_from_trash",
                            title: "<b>"+lang.get('dashboard.congratulations')+"</b>",
                            message: lang.get('dashboard.item_cancel_success',{item:text})
                        }, {
                            type: "success",
                            icon_type: 'class',
                            timer: 1000,
                            placement: {
                                from: "bottom",
                                align: "right"
                            }
                        });
                    }

                    getAjax(null, target, href, false)
                    $(modalID).modal('hide')

                });

        }
    })
}

window.selectPickerAddOption = function (selectElementId, id, value, selected) {
    let options = '';
    if (selected) {
        options = "<option " + "value='" + id + "' selected>" + value + "";

    } else {
        options = "<option " + "value='" + id + "'>" + value + "";

    }
    $('[name="' + selectElementId + '"]').append(options);
    $('[name="' + selectElementId + '"]').selectpicker('refresh');


}

window.loading = function () {
    return '        <div class="loading-div"><div class="auto-load text-center">\n' +
        '            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"\n' +
        '                 x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">\n' +
        '                <path fill="#000"\n' +
        '                      d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">\n' +
        '                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"\n' +
        '                                      from="0 50 50" to="360 50 50" repeatCount="indefinite"/>\n' +
        '                </path>\n' +
        '            </svg>\n' +
        '        </div></div>';
    return '<div class="loading-div"><div class="lds-ripple"><div></div><div></div></div></div>';
}

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    animation: false,
    customClass: 'animated fadeIn',
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

$(document).ready(function () {
    var _originalSize = $(window).width() + $(window).height()
    $(window).resize(function () {
        if ($(window).width() + $(window).height() != _originalSize) {
            $(".fixed-bottom").css("position", "relative");
            $(".modal-footer").css("position", "relative");
        } else {
            $(".fixed-bottom").css("position", "fixed");
            $(".modal-footer").css("position", "fixed");
        }
    });
});

$(document).on('click', '.cancelContract', function (a, b, c) {
    let contractId = $(this).attr('data-contract-id')
    let terminateHref = $(this).attr('data-terminate-href')
    Swal.fire({
        title: lang.get('dashboard.are_you_sure'),
        text:  lang.get('dashboard.are_you_sure_terminate_the_contract'),
        icon: "warning",
        showConfirmButton: true,
        confirmButtonText: 'Sözleşmeyi Sonlandır!',
        showCancelButton: true,
        cancelButtonText: 'İptal!',

    })
        .then((willDelete) => {
            if (willDelete.isConfirmed) {
                Swal.fire({
                    button: 'Tamam',
                    html:
                        '<label class="col-form-label text-left w-100">'+lang.get('dashboard.contract_termination_date')+'</label><div class="bmd-form-group form-group has-success is-filled"><input id="date" class="form-control"></div>' +
                        '<label class="col-form-label text-left w-100">'+lang.get('dashboard.termination_reason_optional')+'</label><div class="bmd-form-group form-group has-success is-filled"><textarea id="reason" class="form-control" rows="5"></textarea></div>',
                    focusConfirm: false,
                    preConfirm: () => {

                        return [
                            document.getElementById('date').value,
                            document.getElementById('reason').value
                        ]
                    },
                    didOpen: () => {
                        $('#date').datetimepicker({
                            defaultDate: new Date(),
                            viewMode: 'years',
                            // language: 'tr',
                            // locale: 'tr',
                            format: user.date_format_js,
                            icons: {
                                date: "fa fa-calendar",
                                up: "fa fa-chevron-up",
                                down: "fa fa-chevron-down",
                                previous: 'fa fa-chevron-left',
                                next: 'fa fa-chevron-right',
                                today: 'fa fa-screenshot',
                                clear: 'fa fa-trash',
                                close: 'fa fa-remove'
                            }
                        });
                    }
                }).then(function (ok) {

                    $.ajax({
                        type: "PUT",
                        url: terminateHref,
                        data: {contract_id: contractId, date: ok.value[0], reason: ok.value[1]},
                        dataType: "json",
                        success: function (data) {
                            Swal.fire({
                                text: lang.get('dashboard.the_contract_has_been_successfully_terminated'),
                                icon: "success",
                            }).then(function (ok) {
                                window.location.reload();
                            });
                        },
                    });
                })
            } else {
                Swal.fire({
                    text: lang.get('dashboard.termination_contract_has_been_cancelled'),
                    icon: "error",
                });
            }
        });
})

window.reloadSortable = function () {
    var delay = 0;
    if ($('#mobile-header').length > 0) {
        delay = 400;
    }
    new Sortable(this, {
        animation: 150,
        handle: '.sortable-handle',
        forceFallback: true,
        fallbackOnBody: true,
        delay: delay,
        // filter: '.static',
        preventOnFilter: false,
        // ghostClass: 'ghost',
        // fallbackClass: 'chosen',
        chosenClass: 'chosen',
        scrollSpeed: 20,
        // draggable: ".sortable-item",
        // Called when dragging element changes position
        onUpdate: function (event) {
            var item_sort = [];
            for (let i = 0; i < event.to.children.length; i++) {
                item_sort[i] = $(event.to.children[i]).attr('data-item-id')
            }
            $.ajax({
                type: "POST",
                url: "item-order/update",
                data: {
                    'item_type': event.to.getAttribute('data-item-type'),
                    'parent_item_id': event.to.getAttribute('data-parent-item-id'),
                    'item_sort': item_sort
                },
                success: function (data) {

                }
            });
        }
    })
}

window.reloadSwipeUnitDetail = function () {
    if ($('#mobile-header').length > 0) {
        const el = document.getElementById('propertyDetailSwipeArea');

        if (el && $('#propertyDetailSwipeArea').swipe("option").length > 0) {


            $('#propertyDetailSwipeArea').swipe({
                swipeLeft: function (event, distance, duration, fingerCount, fingerData, currentDirection) {
                    if ($(event.target).closest('.swipe-disable').length == 0) {
                        $('#mainTab .active').next().find('a').click()
                    }
                },
                swipeRight: function (event, distance, duration, fingerCount, fingerData, currentDirection) {
                    if ($(event.target).closest('.swipe-disable').length == 0) {
                        $('#mainTab .active').prev().find('a').click()
                    }
                },
                allowPageScroll: "auto",
                fingers: $.fn.swipe.fingers.ALL
            });


            $("#mainTab li").on("click", function () {
                $("#mainTab li").removeClass("active");
                $(this).addClass("active");
                // CALL scrollCenter PLUSGIN
                $("#mainTab").scrollCenter(".active", 300);
            });


        }
    }
}

// Bu fonksiyon dropwdownların uzaması sırasında overflowun içerisinde kalmasını engellemektedir.
window.reloadDropdownMenuPosition = function () {
    //add BT DD show event
    $(this).find(".dropdown").on("show.bs.dropdown", function () {
        var $btnDropDown = $(this).find("[data-toggle='dropdown']");
        var $listHolder = $(this).find(".dropdown-menu");
        //reset position property for DD container
        $(this).css("position", "static");
        $listHolder.css({
            top: ($btnDropDown.offset().top + $btnDropDown.outerHeight(true)) + "px",
            left: $btnDropDown.offset().left + "px"
        });
        $listHolder.data("open", true);
    });
    //add BT DD hide event
    $(this).find(".dropdown").on("hidden.bs.dropdown", function () {
        var $listHolder = $(this).find(".dropdown-menu");
        $listHolder.data("open", false);
    });
    //add on scroll for table holder
    $(this).find(".ak-holder").scroll(function () {
        var $ddHolder = $(this).find(".dropdown")
        var $btnDropDown = $(this).find(".dropdown-toggle");
        var $listHolder = $(this).find(".dropdown-menu");
        if ($listHolder.data("open")) {
            $listHolder.css({
                "top": ($btnDropDown.offset().top + $btnDropDown.outerHeight(true)) + "px",
                "left": $btnDropDown.offset().left + "px"
            });
            $ddHolder.toggleClass("open", ($btnDropDown.offset().left > $(this).offset().left))
        }
    })
};

window.reloadShowMoreText = function () {
    var dots = $(this).parent().find(".dots");
    var moreText = $(this).parent().find(".more");

    if ($(dots).css('display') === "none") {
        $(dots).css('display', "inline");
        $(this).text("Read more");
        $(moreText).css('display', "none");
    } else {
        $(dots).css('display', "none");
        $(this).text("Read less");
        $(moreText).css('display', "inline");
    }
}

if ($('#mobile-header').length > 0) {
    var previousScroll = 0;
    var diffScroll = 0;
    $(window).scroll(function () {

            var currentScroll = $(this).scrollTop();
            if (previousScroll !== 0) {
                diffScroll = diffScroll + (previousScroll - currentScroll);
                if (diffScroll > 0) {
                    diffScroll = 0;
                }
                if (diffScroll < -50) {
                    diffScroll = -50
                }

                $('#mobile-header').css('margin-top', diffScroll)
                $('#menuDiv').css('margin-top', diffScroll)


            }
            previousScroll = currentScroll;
        }
    );
}


window.setInputFilter = function (textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
        textbox.addEventListener(event, function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    });
}


jQuery.fn.scrollCenter = function (elem, speed) {

    // this = #timepicker
    // elem = .active

    var active = jQuery(this).find(elem); // find the active element
    //var activeWidth = active.width(); // get active width
    var activeWidth = active.width() / 2; // get active width center

    //alert(activeWidth)

    //var pos = jQuery('#timepicker .active').position().left; //get left position of active li
    // var pos = jQuery(elem).position().left; //get left position of active li
    //var pos = jQuery(this).find(elem).position().left; //get left position of active li
    var pos = active.position().left + activeWidth; //get left position of active li + center position
    var elpos = jQuery(this).scrollLeft(); // get current scroll position
    var elW = jQuery(this).width(); //get div width
    //var divwidth = jQuery(elem).width(); //get div width
    pos = pos + elpos - elW / 2; // for center position if you want adjust then change this

    jQuery(this).animate({
        scrollLeft: pos
    }, speed == undefined ? 1000 : speed);
    return this;
};

// http://podzic.com/wp-content/plugins/podzic/include/js/podzic.js
jQuery.fn.scrollCenterORI = function (elem, speed) {
    jQuery(this).animate({
        scrollLeft: jQuery(this).scrollLeft() - jQuery(this).offset().left + jQuery(elem).offset().left
    }, speed == undefined ? 1000 : speed);
    return this;
};

window.reloadSwiper = function () {
    const swiper = new Swiper('.swiper', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar',
        },
    });
}


