// Function to toggle the menu visibility
function toggleMenu() {
    const headerRight = document.querySelector('.header-right');
    headerRight.style.display = headerRight.style.display === 'flex' ? 'none' : 'flex';
}

// Event listener for DOMContentLoaded to handle the initial display of the header menu
document.addEventListener('DOMContentLoaded', function() {
    const mediaQuery = window.matchMedia('(max-width: 768px)');
    const headerRight = document.querySelector('.header-right');
    headerRight.style.display = mediaQuery.matches ? 'none' : 'flex';
    mediaQuery.addListener(function(e) {
        headerRight.style.display = e.matches ? 'none' : 'flex';
    });
});

// Event listener for form submission to handle sending messages
document.getElementById('message-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const messageInput = document.getElementById('message-input');
    const messageText = messageInput.value;

    // Assuming a simple function to get the current user's username
    const username = getUsername(); 

    // Create and style the message element for sent messages
    const messageElement = document.createElement('div');
    messageElement.className = 'message sent'; // 'sent' for messages sent by the user
    messageElement.innerHTML = `
        <img src="assets/icons/profile.png" alt="Profile Icon" class="profile-icon">
        <span><strong>${username}:</strong> ${messageText}</span>
    `;
    document.getElementById('messages').appendChild(messageElement);

    // Clear the input field after sending the message
    messageInput.value = ''; 

    // Here you would also send the message to the server

    // Example of a received message (you can remove this in your implementation)
    setTimeout(() => {
        const receivedMessage = document.createElement('div');
        receivedMessage.className = 'message received'; // 'received' for messages received
        receivedMessage.innerHTML = `
            <span><strong>OtherUser:</strong> This is a response message.</span>
            <img src="assets/icons/profile.png" alt="Profile Icon" class="profile-icon">
        `;
        document.getElementById('messages').appendChild(receivedMessage);
    }, 1000);
});

// Function to get the current user's username
function getUsername() {
    // This should return the currently logged-in user's username
    // For now, returning a placeholder
    return 'User1';
}
