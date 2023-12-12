// // navigation profile dropdown
// let profileDropdownList = document.querySelector(".profile-dropdown-list");
// let btn = document.querySelector(".nav-profile");

// const toggle = () => profileDropdownList.classList.toggle("active");

// window.addEventListener('click', function(e){
//     if (!btn.contains(e.target)) profileDropdownList.classList.remove("active");
// })

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

// // Attach click event handlers to delete buttons
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
// window.addEventListener("click", function(event) {
//     if (event.target === editmodal) {
//         closeEditModal();
//     }
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

// ================ room message starts from bottom to top =============

document.addEventListener("DOMContentLoaded", function() {
    var container = document.getElementById("scrollbottomtop");

    // Scroll to the bottom on page load
    container.scrollTop = container.scrollHeight;

    // Add an event listener for scrolling
    container.addEventListener("scroll", function() {
        // Check if the user is at the bottom of the container
        if (container.scrollHeight - container.scrollTop === container.clientHeight) {
            // Add your custom logic here
            console.log("At the bottom!");
        }
    });
});