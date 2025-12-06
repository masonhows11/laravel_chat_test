// whisper means other user listen to one channel and sea typing event
let roomId = document.getElementById("room").value;

//// private channel
// let chatChannel = window.Echo.private(`chat.${roomId}`);
//// this project for presence channel
let chatChannel = window.Echo.join(`chat.${roomId}`);
//
let current_name = window.current_user_name;
let typing = true
let typingTimers = {}
let isTyping = document.getElementById('isTyping');
let onlineUsers = document.getElementById('onlineUsers');
let usersObject = [];
let onlineUsersItems = '';

//
function clearOnlineUserList() {
    while (onlineUsers.hasChildNodes()) {
        onlineUsers.removeChild(onlineUsers.firstChild);
    }
}

// first create the object form user / users
// then make element li from abject list
function updateUsers(usersObject) {
    clearOnlineUserList();
    for (let i = 0; i < usersObject.length; i++) {
        onlineUsersItems += '<li  class="list-group-item">' + usersObject[i]['name'] + '</li>';
    }
    onlineUsers.innerHTML += onlineUsersItems;
}

// listen for response user typing
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
    updateUsers(usersObject);

}).joining(user => {
    console.log('join')
    console.log(user.name)
    const obj = {
        id: user.id,
        name: user.name,
    }
    console.log(obj)
    console.log(usersObject)
    usersObject.push(obj)
    updateUsers(usersObject);


}).leaving(user => {
    // updateUsers(user);
}).listenForWhisper('typing', (e) => {

    // this other_name is my name when I'm typing something
    // then display to others like naeem is typing
    let other_name = e.user_name;
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
    }, 2000);

})

//// listen for user typing
window.typingWhisper = function (event) {
    // this code send data like name with whisper
    // to other user/users
    chatChannel.whisper("typing", {
        user_name: current_name,
    })
}
