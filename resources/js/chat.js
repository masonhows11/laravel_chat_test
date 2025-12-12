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

import axios from 'axios';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


//// private channel
// let chatChannel = window.Echo.private(`chat.${roomId}`);

//// this project for presence channel
let roomId = document.getElementById("roomId").value;
// get csrf-token
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
// set csrf-token in axios header
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
}
//
let chatChannel = window.Echo.join(`chat.${roomId}`);
//
let current_name = window.current_user.name;
let current_id = window.current_user.id;
let typingTimers = {}
let isTyping = document.getElementById('isTyping');
let onlineUsers = document.getElementById('onlineUsers');
let usersObject = [];
let onlineUsersItems = '';
let clearMessage = document.getElementById('clearMessage');
let inputMessage = document.getElementById('inputMessage');
let sendMessageBtn = document.getElementById('sendMessage');
let boxMessage = document.getElementById('boxMessage');
clearMessage.addEventListener('click', (event) => {
    event.preventDefault();
    inputMessage.value = '';
})

//// update users online list ////
function updateUsers() {
    onlineUsersItems = '';
    for (let i = 0; i < usersObject.length; i++) {
        onlineUsersItems += '<li  class="list-group-item">' + usersObject[i]['name'] + '</li>';
    }
    onlineUsers.innerHTML = onlineUsersItems;
}

//// listen for response user typing (call whisper) ////
// other user/users listen for whisper that
// send from specific user/users
chatChannel.here(users => {
    users.forEach(user => {
        const obj = {
            id: user.id,
            name: user.name,
        }
        usersObject.push(obj)
    })
    updateUsers();
}).joining(user => {
    const obj = {
        id: user.id,
        name: user.name,
    }
    usersObject.push(obj)
    updateUsers();
}).leaving((user) => {
    usersObject = usersObject.filter(u => u.id !== user.id);
    updateUsers();
}).listenForWhisper('typing', (e) => {
    // this other_name is my name when I'm typing something
    // then display to others
    // like naeem is typing or mamad is typing or sara is typing
    let other_name = e.user_name;
    isTypingHandle(other_name);
})

//// handle user typing whisper ////
function isTypingHandle(other_name) {
    // first step
    isTyping.innerHTML = `${other_name} is typing... `;
    // second step
    if (typingTimers[other_name]) {
        clearTimeout(typingTimers[other_name])
    }
    // third step
    typingTimers[other_name] = setTimeout(() => {
        isTyping.innerHTML = '';
        delete typingTimers[other_name]
    }, 3000);
}

//// listen for user typing ////
window.typingWhisper = function (event) {
    // this code send data like name,id,message,with whisper
    // to other user/users
    chatChannel.whisper("typing", {
        user_name: current_name,
    })
}


//// method for send message to server for save ////
sendMessageBtn.addEventListener('click', (event) => {
    event.preventDefault();
    if (inputMessage.value === '') {
        document.getElementById('messageError').style.display = 'block';
        return null
    }
    axios.post('/store/message', {
        user_id: current_id,
        room_id: parseInt(roomId),
        message: inputMessage.value
    }).then(function (response) {
        console.log(response)
    }).catch(function (error) {
        console.log(error);
    })
    inputMessage.value = '';
})

// to listen other user / users on PresenceChannel
// use join() method instead channel() its very important
window.Echo.join(`chat.${roomId}`).listen('.message.sent', (e) => {
    // update the chat box with incoming messages

    let messageId = e.id;
    let message = e.message;
    let user_id = e.user_id;
    let sender = e.sender;
    //// better way
    let card = document.createElement('div');
    card.className = 'card my-2';
    card.innerHTML = `
    <div class="card-body">
         <div class="d-flex justify-content-between">
         <div>
         <span class="card-subtitle text-muted">${sender}</span>
         </div>
         <div>
         <button id="removeMessage-${messageId}" data-messageId="${messageId}" class="mb-4 border border-0 bg-transparent btnRemoveMessage">
         <i class="fa-solid fa-trash-alt text-danger"></i>
         </button>
         </div>
         </div>
         <p>${message}</p>
         </div>
    `;
    boxMessage.appendChild(card);
})

boxMessage.addEventListener("click",function (e) {
    const btn = e.target.closest(".btnRemoveMessage");
    if(!btn) return;
    const message_id = parseInt(btn.getAttribute('data-messageId'));
    console.log(message_id)
    // stop here
    // btn.closest('.card').remove();
})


