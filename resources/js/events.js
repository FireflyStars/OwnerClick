document.addEventListener('DOMContentLoaded', function () {
    if($('#events-section').length>0){
        listenerEvent()
    }

});
var target
var href
var isLoading = false
window.listenerEvent = function () {

    page = 1;
    target = $('#events-section').attr('data-target');
    href = $('#events-section').attr('data-href');
    getEvents(page)

    $('#events-section').scroll(function () {
        if ($(this).scrollTop() + $(this).height() >= $(this).find('.event-data >div:last')[0].offsetTop) {
            if (!isLoading) {
                page++;
                getEvents(page);
            }
        }
    });
    $('#navbarDropdownMenuLinkSection').on('click', function (e) {
        e.stopPropagation();
    });

    $('#navbarDropdownMenuLink .notification').on('change', function () {
        if ($(this).text() == 0) {
            $(this).hide()
        } else {
            $(this).show()
        }
    })


}

window.getEvents = function (page) {
    $.ajax({
        url: href + "?page=" + page,
        datatype: "html",
        type: "get",
        beforeSend: function () {
            isLoading = true
            $('.auto-load').show();
        }
    })
        .done(function (response) {
            if (response.length == 0) {
                if (page == 1) {
                    $('#no-notification-section').removeClass('d-none')
                }
                $('.auto-load').html("");
                return;
            } else {
                $('#no-notification-section').addClass('d-none')

                $('.auto-load').hide();
                $(target).append(response);
                isLoading = false
            }
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            isLoading = false
        });
}
