document.addEventListener('DOMContentLoaded', function() {
    // Toggle menu visibility
    const mediaQuery = window.matchMedia('(max-width: 768px)');
    const headerRight = document.querySelector('.header-right');

    function handleMediaQueryChange(e) {
        headerRight.style.display = e.matches ? 'none' : 'flex';
    }

    handleMediaQueryChange(mediaQuery);
    mediaQuery.addListener(handleMediaQueryChange);

    // Handle form submission to send messages
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

        // Scroll to the bottom of the messages
        messageElement.scrollIntoView({ behavior: 'smooth', block: 'end' });

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

            // Scroll to the bottom of the messages
            receivedMessage.scrollIntoView({ behavior: 'smooth', block: 'end' });
        }, 1000);
    });

    // Function to get the current user's username
    function getUsername() {
        // This should return the currently logged-in user's username
        // For now, returning a placeholder
        return 'User1';
    }

    // Read More button functionality
    const readMoreButtons = document.querySelectorAll('.read-more-btn');

    readMoreButtons.forEach(button => {
        button.addEventListener('click', function() {
            const description = this.previousElementSibling;
            if (description.style.display === 'none' || description.style.display === '') {
                description.style.display = 'block';
                this.textContent = 'Read less';
            } else {
                description.style.display = 'none';
                this.textContent = 'Read more';
            }
        });
    });
});
