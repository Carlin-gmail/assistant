document.addEventListener('DOMContentLoaded', function() {
    const chatButton = document.querySelector('#chat-button');
    const chat = document.getElementById('chat');
    const chatClose = document.querySelector('#chat-close');

    chatButton.addEventListener('click', function() {
        chatButton.classList.toggle('d-none');
        chat.classList.toggle('d-none');
    });

    chatClose.addEventListener('click', function() {
        chatButton.classList.toggle('d-none');
        chat.classList.toggle('d-none');
    });
});
