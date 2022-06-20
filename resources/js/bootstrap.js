window._ = require('lodash');
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('popper.js').default; // default is very important.
    window.Swal = require('sweetalert2');
    require('jquery-touchswipe');
    window.moment = require('moment');
    // window.dt = require('datatables.net');
    // require('datatables.net-bs5');
    // require('datatables.net-select-bs5');
    require('./fullcalendar');
    // require('./permissions');
    require('./notifications');
    require('./events');

    window.aos = require('aos')
//
} catch (e) {
    console.log(e);
    console.log('patladı')
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import $ from "jquery";
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
    encrypted: true
});
window.Echo.connector.pusher.bind('reconnect', (channel, data) => {
    console.log('RE-CONNECTED');
});

window.Echo.connector.pusher.bind('reconnecting', (channel, data) => {
    console.log('re-connecting...');
});

window.Echo.connector.pusher.bind('reconnect_error', (channel, data) => {
    console.log('reconnection error!');
});

window.Echo.connector.pusher.bind('reconnect_attempt', (channel, data) => {
    console.log('re-connecting...');
});

window.Echo.connector.pusher.bind('connect_error', (channel, data) => {
    console.log('connect error...');
});

window.Echo.connector.pusher.bind('error', (channel, data) => {
    console.log('error...');
});

window.Echo.connector.pusher.bind_global((channel, data) => {
    console.log('g',data)
    // $.notify({
    //     icon: "check",
    //     title :"<b>"+data.title+"</b>",
    //     message: data.message
    // }, {
    //     type: "success",
    //     icon_type: 'class',
    //     timer: 1000,
    //     placement: {
    //         from: "bottom",
    //         align: "right"
    //     }
    // });
});
window.Echo.channel('payment.created')
    .listen('testing', (e) => {
        console.log(e);
    });
window.Echo.channel('payment-dept.created')
    .listen('testings', (e) => {
        console.log(e);
    });
window.Echo.connector.pusher.connection.bind('connecting', (payload) => {

    /**
     * All dependencies have been loaded and Channels is trying to connect.
     * The connection will also enter this state when it is trying to reconnect after a connection failure.
     */

    console.log('connecting...');

});

window.Echo.connector.pusher.connection.bind('connected', (payload) => {

    /**
     * The connection to Channels is open and authenticated with your app.
     */

    console.log('connected!', payload);
});

window.Echo.connector.pusher.connection.bind('unavailable', (payload) => {

    /**
     *  The connection is temporarily unavailable. In most cases this means that there is no internet connection.
     *  It could also mean that Channels is down, or some intermediary is blocking the connection. In this state,
     *  pusher-js will automatically retry the connection every 15 seconds.
     */

    console.log('unavailable', payload);
});

window.Echo.connector.pusher.connection.bind('failed', (payload) => {

    /**
     * Channels is not supported by the browser.
     * This implies that WebSockets are not natively available and an HTTP-based transport could not be found.
     */

    console.log('failed', payload);

});

window.Echo.connector.pusher.connection.bind('disconnected', (payload) => {

    /**
     * The Channels connection was previously connected and has now intentionally been closed
     */

    console.log('disconnected', payload);

});

window.Echo.connector.pusher.connection.bind('message', (payload) => {

    /**
     * Ping received from server
     */

    console.log('message', payload);
    if(typeof payload.data.title !== "undefined") {
        // const Toast = Swal.mixin({
        //     toast: true,
        //     position: 'top-end',
        //     showConfirmButton: false,
        //     timer: 3000,
        //     timerProgressBar: true,
        //     didOpen: (toast) => {
        //         toast.addEventListener('mouseenter', Swal.stopTimer)
        //         toast.addEventListener('mouseleave', Swal.resumeTimer)
        //     },
        //     showEasing: "swing",
        //     hideEasing: "linear",
        //     showMethod: "fadeIn",
        //     hideMethod: "fadeOut"
        // })
        // Toast.fire({
        //     icon: payload.data.icon,
        //     title: payload.data.title,
        //     text: payload.data.message
        // })
        //
        // $.notify({
        //     icon: payload.data.icon,
        //     title: "<b>" + payload.data.title + "</b>",
        //     message: payload.data.message
        // }, {
        //     type: "notification",
        //     closeButton: true,
        //     timeOut: 45000,
        //     autoHide: false,
        //     icon_type: 'class',
        //     placement: {
        //         from: "top",
        //         align: "right"
        //     }
        // });
    }
});

window.Echo.private(`App.User.`+userId)
    .notification((notification) => {
        console.log('test');
        console.log(notification.type,notification.id);
        switch(notification.type){
            case "App\\Notifications\\ReadNotificationNotification":
                $('.notification').text(parseInt($('.notification').text())-1).trigger('change')
                convertNotificationElementToRead($("[data-notification-id='"+notification.nid+"']")[0])
                break;
            case "App\\Notifications\\UnreadNotificationNotification":
                $('.notification').text(parseInt($('.notification').text())+1).trigger('change')
                convertNotificationElementToUnRead($("[data-notification-id='"+notification.nid+"']")[0])

                break;
            default: $('.notification').text(parseInt($('.notification').text())+1).trigger('change')
        }

    });

// // Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;
//
// var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER
// });
//
// var channel = pusher.subscribe('payment');
// channel.bind('created', function (data) {
//     console.log(JSON.stringify(data));
// });
