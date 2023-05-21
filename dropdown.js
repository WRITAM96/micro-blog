function toggleDropdown(event) {
    var dropdownMenu = event.currentTarget.parentElement.querySelector('.dropdown-menu');
    if (!event.target.matches('a') && !event.target.parentElement.matches('a')) {
        // Check if clicked element is not a link or a child of a link
        dropdownMenu.classList.toggle('show');
    } else {
        // Redirect to the link's href attribute
        window.location.href = event.target.href;
    }
}

function hideDropdown(event) {
    var dropdownMenus = document.getElementsByClassName('dropdown-menu');
    for (var i = 0; i < dropdownMenus.length; i++) {
        var openDropdownMenu = dropdownMenus[i];
        if (openDropdownMenu.classList.contains('show') && !openDropdownMenu.contains(event.target)) {
            openDropdownMenu.classList.remove('show');
        }
    }
}

document.addEventListener('mousedown', hideDropdown);
