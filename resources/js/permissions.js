document.addEventListener('DOMContentLoaded', function() {
    changePermission()

});

window.changePermission = function() {

    $('.change-permission').on('click',function (e){
        e.preventDefault()
        var item = $(this)
        $.getJSON({url: $(this).attr('data-target'), method: 'PUT'}).always(function (data) {
            if(data.data.authorize === 'add'){
                item.find('i').html('check')
                item.find('i').removeClass('rectangle-not-check')
            }else{
                item.find('i').html('clear')
                item.find('i').addClass('rectangle-not-check')

            }
        })
    })
}


window.changePermission = function() {

    $('#addUserToPermission').on('click',function (e){



    })
}

