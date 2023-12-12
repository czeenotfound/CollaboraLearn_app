// navigation profile dropdown
let profileDropdownList = document.querySelector(".profile-dropdown-list");
let btn = document.querySelector(".nav-profile");

const toggle = () => profileDropdownList.classList.toggle("active");

window.addEventListener('click', function(e){
    if (!btn.contains(e.target)) profileDropdownList.classList.remove("active");
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

// enabling scrolling body
document.querySelector('.createroom').addEventListener('click',
function(){
    document.body.style.overflowY = 'scroll';
})

document.querySelector('.createroom').addEventListener('click',
function(){
    document.querySelector('.bg-modal').style.display = 'none';
})


// // edit-modal edit config
// const editmodal = document.getElementById("edit-modal");
// const editButtons = document.querySelectorAll(".edit-button");
// const confirmEditButton = document.getElementById("confirm-edit");
// const cancelEditButton = document.getElementById("cancel-edit");

// // Function to open the modal
// function openEditModal() {
//     editmodal.style.display = "block";
// }

// // Function to close the modal
// function closeEditModal() {
//     editmodal.style.display = "none";
// }

// document.getElementById('edit-modal').addEventListener('click',
// function(){
//     document.body.style.overflowY = 'hidden';
// })

// enabling scrolling body
// document.getElementById('cancel-edit').addEventListener('click',
// function(){
//     document.body.style.overflowY = 'scroll';
// })

// Attach click event handlers to delete buttons
// editButtons.forEach(button => {
//     button.addEventListener("click", openEditModal);
// });

// // Attach click event handlers to confirm and cancel buttons
// confirmEditButton.addEventListener("click", function() {
//     // Handle deletion logic here
//     // You can add code to delete the corresponding card or perform other actions
//     closeEditModal();
// });

// cancelEditButton.addEventListener("click", closeEditModal);

// // Close the modal if the user clicks outside the modal
// // window.addEventListener("click", function(event) {
// //     if (event.target === editmodal) {
// //         closeEditModal();
// //     }
// // });
// // Close the modal if the user clicks outside the modal
// window.addEventListener("click", function(event) {
//     if (event.target === editmodal) {
//         closeEditModal();
//         enableScrollbar(); // Call function to enable scrollbar
//     }
// });

// // Function to enable scrollbar
// function enableScrollbar() {
//     document.body.style.overflowY = 'scroll';
// }

// // Add event listener to the "cancel-edit" button
// document.getElementById('cancel-edit').addEventListener('click', function(){
//     closeEditModal(); // Close the modal
//     enableScrollbar(); // Enable the scrollbar
// });

// // bg-modal delete confirmation
// // Get modal and buttons
// const modal = document.getElementById("delete-modal");
// const deleteButtons = document.querySelectorAll(".delete-button");
// const confirmDeleteButton = document.getElementById("confirm-delete");
// const cancelDeleteButton = document.getElementById("cancel-delete");

// // Function to open the modal
// function openModal() {
//     modal.style.display = "block";
// }

// // Function to close the modal
// function closeModal() {
//     modal.style.display = "none";
// }

// // Attach click event handlers to delete buttons
// deleteButtons.forEach(button => {
//     button.addEventListener("click", openModal);
// });

// // Attach click event handlers to confirm and cancel buttons
// confirmDeleteButton.addEventListener("click", function() {
//     // Handle deletion logic here
//     // You can add code to delete the corresponding card or perform other actions
//     closeModal();
// });

// cancelDeleteButton.addEventListener("click", closeModal);

// // Close the modal if the user clicks outside the modal
// window.addEventListener("click", function(event) {
//     if (event.target === modal) {
//         closeModal();
//     }
// });

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