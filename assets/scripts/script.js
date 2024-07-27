function toggleMenu() {
    const headerRight = document.querySelector('.header-right');
    headerRight.style.display = headerRight.style.display === 'flex' ? 'none' : 'flex';
}

document.addEventListener('DOMContentLoaded', function() {
    const mediaQuery = window.matchMedia('(max-width: 768px)');
    const headerRight = document.querySelector('.header-right');
    headerRight.style.display = mediaQuery.matches ? 'none' : 'flex';
    mediaQuery.addListener(function(e) {
        headerRight.style.display = e.matches ? 'none' : 'flex';
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const mediaQuery = window.matchMedia('(max-width: 768px)');
    const headerRight = document.querySelector('.header-right');
    headerRight.style.display = mediaQuery.matches ? 'none' : 'flex';
    mediaQuery.addListener(function(e) {
        headerRight.style.display = e.matches ? 'none' : 'flex';
    });
});

document.getElementById('message-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const messageInput = document.getElementById('message-input');
    const messageText = messageInput.value;

    // Assuming a simple function to get the current user's username
    const username = getUsername(); 

    const messageElement = document.createElement('div');
    messageElement.className = 'message';
    messageElement.innerHTML = `
        <img src="assets/icons/profile.png" alt="Profile Icon" class="profile-icon">
        <strong>${username}:</strong> ${messageText}
    `;
    document.getElementById('messages').appendChild(messageElement);

    messageInput.value = ''; // Clear the input field

    // Here you would also send the message to the server
});

function getUsername() {
    // This should return the currently logged-in user's username
    // For now, returning a placeholder
    return 'User1';
}