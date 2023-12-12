// navigation profile dropdown
let profileDropdownList = document.querySelector(".profile-dropdown-list");
let btn = document.querySelector(".nav-profile");

const toggle = () => profileDropdownList.classList.toggle("active");

window.addEventListener('click', function(e){
    if (!btn.contains(e.target)) profileDropdownList.classList.remove("active");
})

// sidebar

const menuItems = document.querySelectorAll('.menu-item');

// messages
const messagesNotification = document.querySelector('#messages-notification');
const messages = document.querySelector('.messages');
const message = messages.querySelectorAll('.message');
const messageSearch = document.querySelector('#message-search');


// remove active class for all menu items
const changeActiveItem = () => {
    menuItems.forEach(item => {
        item.classList.remove('active');
    })
}

menuItems.forEach(item => {
    item.addEventListener('click', () => {
        changeActiveItem();
        item.classList.add('active');
        if(item.id != 'notifications'){
            document.querySelector('.notif-popup').style.display = 'none';
        }
        else{
            document.querySelector('.notif-popup').style.display = 'block';
            document.querySelector('#notifications .notification-count').style.display = 'none';
        }
    })
})

// messages

// searches chats
const searchMessage = () => {
    const val = messageSearch.value.toLowerCase();
    message.forEach(user => {
        let name = user.querySelector('h5').textContent.toLowerCase();
        if(name.indexOf(val) != -1){
            user.style.display = 'flex';
        } else{
            user.style.display = 'none';
        }
    })
}

// search chat
messageSearch.addEventListener('keyup', searchMessage);


// highlighting the message section when cliked thru sidebar
messagesNotification.addEventListener('click', () => {
    messages.style.boxShadow = '0 0 1rem var(--color-primary)';
    messagesNotification.querySelector('.notification-count').style.display = 'none';
    setTimeout(() => {
        messages.style.boxShadow = 'none';
    }, 2000);
})


// Text Input Create a Study Room 

document.getElementById('create-room').addEventListener('click',
function(){
    document.querySelector('.bg-modal').style.display = 'flex';
})

document.querySelector('.close').addEventListener('click',
function(){
    document.querySelector('.bg-modal').style.display = 'none';
})

// disable scrolling body
document.getElementById('create-room').addEventListener('click',
function(){
    document.body.style.overflowY = 'hidden';
})

// enabling scrolling body
document.querySelector('.close').addEventListener('click',
function(){
    document.body.style.overflowY = 'scroll';
})

// Browse topics

const tabs = document.querySelectorAll(".browse-topics a");
const leftArrow = document.querySelector(".browse-topics .left-arrow i");
const rightArrow = document.querySelector(".browse-topics .right-arrow i");

const tabsList = document.querySelector(".browse-topics .browse-links ul");

const leftArrowContainer = document.querySelector(".browse-topics .left-arrow");
const rightArrowContainer = document.querySelector(".browse-topics .right-arrow");

const removeAllActiveClasses = () => {
    tabs.forEach(tab => {
        tab.classList.remove("active");
    })
}

tabs.forEach(tab => {
    tab.addEventListener("click", () => {
        removeAllActiveClasses();
        tab.classList.add("active");
    } )
})

const manageIcons = () => {
    if (tabsList.scrollLeft >= 20) {
        leftArrowContainer.classList.add("active");
    } else{
        leftArrowContainer.classList.remove("active");
    }

    let maxScrollValue = tabsList.scrollWidth - tabsList.clientWidth - 20;
    console.log("scroll width: ", tabsList.scrollWidth);
    console.log("client width: ", tabsList.clientWidth);

    if(tabsList.scrollLeft >= maxScrollValue) {
        rightArrowContainer.classList.remove("active");
    } else{
        rightArrowContainer.classList.add("active");
    }
}

leftArrow.addEventListener("click", () => {
    tabsList.scrollLeft -= 200;
    manageIcons();
})

rightArrow.addEventListener("click", () => {
    tabsList.scrollLeft += 200;
    manageIcons();
})



// edit-modal edit config
const editmodal = document.getElementById("edit-modal");
const editButtons = document.querySelectorAll(".edit-button");
const confirmEditButton = document.getElementById("confirm-edit");
const cancelEditButton = document.getElementById("cancel-edit");

// Function to open the modal
function openEditModal() {
    editmodal.style.display = "block";
}

// Function to close the modal
function closeEditModal() {
    editmodal.style.display = "none";
}

// Attach click event handlers to delete buttons
editButtons.forEach(button => {
    button.addEventListener("click", openEditModal);
});

// Attach click event handlers to confirm and cancel buttons
confirmEditButton.addEventListener("click", function() {
    // Handle deletion logic here
    // You can add code to delete the corresponding card or perform other actions
    closeEditModal();
});

cancelEditButton.addEventListener("click", closeEditModal);

// Close the modal if the user clicks outside the modal
window.addEventListener("click", function(event) {
    if (event.target === editmodal) {
        closeEditModal();
    }
});


// bg-modal delete confirmation
// Get modal and buttons
const modal = document.getElementById("delete-modal");
const deleteButtons = document.querySelectorAll(".delete-button");
const confirmDeleteButton = document.getElementById("confirm-delete");
const cancelDeleteButton = document.getElementById("cancel-delete");

// Function to open the modal
function openModal() {
    modal.style.display = "block";
}

// Function to close the modal
function closeModal() {
    modal.style.display = "none";
}

// Attach click event handlers to delete buttons
deleteButtons.forEach(button => {
    button.addEventListener("click", openModal);
});

// Attach click event handlers to confirm and cancel buttons
confirmDeleteButton.addEventListener("click", function() {
    // Handle deletion logic here
    // You can add code to delete the corresponding card or perform other actions
    closeModal();
});

cancelDeleteButton.addEventListener("click", closeModal);

// Close the modal if the user clicks outside the modal
window.addEventListener("click", function(event) {
    if (event.target === modal) {
        closeModal();
    }
});

// EditProfile Modal
const editProfilebuttons = document.querySelectorAll(".editProfile-button");
const editProfileClosebutton = document.getElementById("close-editProfile");
const editProfileModal = document.getElementById("editProfile-modal");
const profileForm = document.getElementById("confirm-editProfile");

function openEditProfileModal() {
    editProfileModal.style.display = "block";
}

// Function to close the modal
function closeEditProfileModal() {
    editProfileModal.style.display = "none";
}

editProfilebuttons.forEach(button => {
    button.addEventListener("click", openEditProfileModal);
});

editProfileClosebutton.addEventListener("click", function() {
    closeEditProfileModal();
});



profileForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const profilePicture = document.getElementById("profilePicture").value;
    const bio = document.getElementById("bio").value;
    const interests = document.getElementById("interests").value;
    const methods = document.getElementById("methods").value;
    const availability = document.getElementById("availability").value;

    editProfileModal.style.display = "none";


    
});