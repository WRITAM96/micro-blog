function toggleDropdown(event) {
    var dropdownMenu = event.currentTarget.nextElementSibling;
    dropdownMenu.classList.toggle('show');
}

function openUpdateModal(postId) {
    var modal = document.getElementById('update-modal');
    var modalContent = document.getElementById('update-modal-content');
    var closeButton = document.getElementById('update-modal-close');
    modal.style.display = 'flex';
    modalContent.innerHTML = ''; // Clear previous content

    // Load update_post.php content into the modal
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                modalContent.innerHTML = xhr.responseText;
            } else {
                modalContent.innerHTML = 'Error loading content.';
            }
        }
    };
    xhr.open('GET', 'update_post.php?post_id=' + postId, true);
    xhr.send();

    closeButton.onclick = function(event) {
        event.preventDefault();
        modal.style.display = 'none';
		  if (!refreshIntervalId) {
        refreshPosts(); // If the modal is closed, refresh posts immediately
        startRefreshInterval(); // Resume the 5-second refresh interval
    }
    };

    modal.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
	    if (refreshIntervalId) {
        stopRefreshInterval(); // If the modal is open, stop the refresh interval
    }
}

window.addEventListener('load', function() {
    var modals = document.getElementsByClassName('modal');
    for (var i = 0; i < modals.length; i++) {
        modals[i].style.display = 'none';
    }
	startRefreshInterval();
});
