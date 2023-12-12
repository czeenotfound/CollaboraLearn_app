// popup.js

function displayPopup(message) {
    // Display the popup
    var popup = document.createElement('div');
    popup.className = 'popup';
    popup.innerHTML = '<span class="close-btn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' + message;
    document.body.appendChild(popup);

    // Close the popup after 5 seconds (adjust as needed)
    setTimeout(function() {
        popup.style.display = 'none';
    }, 5000);
}
