
document.addEventListener('DOMContentLoaded', function() {
    listenerNotification()

});
var target
var href
var isLoading = false
window.listenerNotification = function() {


    $( '#notificationDropdown').on('show.bs.dropdown', function (e) {
        page = 1;
        $('#navbarDropdownMenuLinkSection .notification-data').html('');
        target = $(this).attr('data-target');
        href = $(this).attr('data-href');
            getNotifications(page)
    })

    $( '#navbarDropdownMenuLinkSection').scroll(function () {
        console.log($(this).scrollTop()+$(this).height()   >=  $(this).find('.notification-data >div:last')[0].offsetTop,$(this),$(this).scrollTop()  , $(this).find('.notification-data >div:last')[0].offsetTop , $(this).height())
        if ($(this).scrollTop()+$(this).height()   >=  $(this).find('.notification-data >div:last')[0].offsetTop) {
            if(!isLoading){
                page++;
                getNotifications(page);
            }
        }
    });
    $('#navbarDropdownMenuLinkSection').on('click', function(e) {
        e.stopPropagation();
    });

    $('#navbarDropdownMenuLink .notification').on('change',function(){
        if($(this).text() == 0){
            $(this).hide()
        }else{
            $(this).show()
        }
    })



}

window.getNotifications = function (page){
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
                if(page == 1){
                    $('#no-notification-section').removeClass('d-none')
                }
                $('.auto-load').html("");
                return;
            }else {
                $('#no-notification-section').addClass('d-none')

                $('.auto-load').hide();
                $(target).append(response);
                isLoading = false
                readNotification()
            }
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occured');
            isLoading = false
        });
}

window.convertNotificationElementToRead = function (element) {
    $(element).removeClass('unreadNotificationBorder')
    $(element).addClass('text-gray')
    $(element).find('.notification-circle-mini').addClass('bg-gray').addClass('text-black-50').removeClass('text-white')
}

window.convertNotificationElementToUnRead = function (element) {
    $(element).addClass('unreadNotificationBorder')
    $(element).removeClass('text-gray')
    $(element).find('.notification-circle-mini').removeClass('bg-gray').removeClass('text-black-50').addClass('text-white')
}

window.readNotification = function (){
    $('#navbarDropdownMenuLinkSection .dropdown-item').off('click').on('click',function (){
        let link;
        if($(this).hasClass('unreadNotificationBorder')){
             link = '/push/notifications/read/';
            $.ajax({
                url: link + $(this).attr('data-notification-id'),
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    isLoading = true
                    $('.auto-load').show();
                }
            })
                .done(function (response) {

                })
        }else{
             link = '/push/notifications/unread/';
        }
        let element = this

        getAjax($(this),$(this).attr('data-target'),$(this).attr('data-href'),true,false)



    })
}
