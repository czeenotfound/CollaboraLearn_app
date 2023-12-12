var mainContent = document.querySelector('.main');
var menuIcon = document.getElementById('menu-icon');
var verticalNav = document.getElementById('VerticalNav');

menuIcon.addEventListener('click', function() {
    if (verticalNav.style.display === 'none' || verticalNav.style.display === '') {
        verticalNav.style.display = 'block';
        mainContent.style.marginLeft = '270px';
    } else {
        verticalNav.style.display = 'none';
        mainContent.style.marginLeft = '0';
    }
});

document.body.addEventListener('click', function(event) {
    // Close the vertical navigation if the click is outside the navigation and the menu icon
    if (!event.target.closest('#VerticalNav') && !event.target.closest('#menu-icon')) {
        verticalNav.style.display = 'none';
        mainContent.style.marginLeft = '0';
    }
});