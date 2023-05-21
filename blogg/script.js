// Refresh the posts every 5 seconds
setInterval(function() {
	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'display_posts.php', true);
	xhr.onload = function() {
		if (xhr.status == 200) {
			document.getElementById('posts').innerHTML = xhr.responseText;
		}
	};
	xhr.send();
}, 5000);
