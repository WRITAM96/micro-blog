var refreshIntervalId; // Variable to store the interval ID

function refreshPosts() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'display_posts.php', true);
    xhr.onload = function() {
        if (xhr.status == 200) {
            document.getElementById('posts').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

function startRefreshInterval() {
    refreshIntervalId = setInterval(refreshPosts, 5000);
}

function stopRefreshInterval() {
    clearInterval(refreshIntervalId);
}
        function scrollToTop() {
            const postFeed = document.getElementById("posts");
            postFeed.scrollTop = 0;
        }