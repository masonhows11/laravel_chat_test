// whisper means other user listen to one channel and sea typing event
let roomId = document.getElementById("room").value;
let chatChannel = window.Echo.private(`chat.${roomId}`);
let current_name = window.current_user_name;
let typing = true
let typingTimers = {}
let isTyping = document.getElementById('isTyping');
//// listen for response user typing

//// other user/user listen for whisper send from specific user/users
chatChannel.listenForWhisper('typing', (e) => {

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
