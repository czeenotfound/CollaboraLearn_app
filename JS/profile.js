// // navigation profile dropdown
// let profileDropdownList = document.querySelector(".profile-dropdown-list");
// let btn = document.querySelector(".nav-profile");

// const toggle = () => profileDropdownList.classList.toggle("active");

// window.addEventListener('click', function(e){
//     if (!btn.contains(e.target)) profileDropdownList.classList.remove("active");
// })

// EditProfile Modal
const editProfilebuttons = document.querySelectorAll(".editProfile-button");
const editProfileClosebutton = document.getElementById("close-editProfile");
const editProfileModal = document.getElementById("editProfile-modal");
const profileForm = document.getElementById("confirm-editProfile");
const profilePictureInput = document.getElementById("profilePicture");
const imagePreview = document.getElementById("imagePreview");

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

profilePictureInput.addEventListener("change", () => {
    // Display the selected image in the preview
    const file = profilePictureInput.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.src = e.target.result;
            imagePreview.style.display = "block";
        };
        reader.readAsDataURL(file);
    } else {
        // If no image selected, hide the preview
        imagePreview.src = "";
        imagePreview.style.display = "none";
    }
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
