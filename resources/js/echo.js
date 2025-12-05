import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    encrypted: true,
});


// نوشتن اسکریپت داخل فایلی که Echo لود میشه جواب میده
// ولی نوشتن اسکریپت داخل  یک فایل دیگه خارج از این جوا ب
// نمیده نمیدونم !!؟؟؟
// window.Echo.channel('tasks')
//         .listen('.task.added', e => {
//             console.log('new task added successfully');
//             console.log(e)
//         })

// wsHost: import.meta.env.VITE_PUSHER_HOST,
// wsPort: import.meta.env.VITE_PUSHER_PORT,
// wssPort: import.meta.env.VITE_PUSHER_PORT,
//
// enabledTransports: ["ws", "wss"],

// window.Echo.channel('order-status-updated')
//     .listen('OrderStatusUpdated',e =>{
//         console.log('order has been updated behind the scenes' + '\n' + 'order id is : ' + e.order.id);
//         console.log(e)
//     })
