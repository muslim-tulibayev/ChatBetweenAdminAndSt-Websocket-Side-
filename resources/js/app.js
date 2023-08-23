import './bootstrap';

if (sessionStorage.getItem('token') === null)
    location.href = '/login'

const messagesList = document.getElementById('messagesList');
const messageInput = document.getElementById('messageInput');
const sendButton = document.getElementById('sendButton');

const channel = Echo.private('chat.all');

channel.subscribed(() => {
    console.log('Subscribed!')
}).listen('.chat', (event) => {
    messagesList.innerHTML += `<li>${event.username + ': ' + event.message}</li>`;
    window.scrollTo(0, document.body.scrollHeight);
})

sendButton.addEventListener('click', async function () {
    const data = {
        message: messageInput.value
    }

    const res = await axios.post('/api/chat', data, {
        headers: { Authorization: `Bearer ${sessionStorage.getItem('token')}` }
    })

    messageInput.value = '';
})

messageInput.addEventListener("keyup", function (event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        sendButton.click();
    }
})