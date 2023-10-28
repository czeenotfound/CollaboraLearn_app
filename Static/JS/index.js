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

