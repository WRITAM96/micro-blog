function updateCharacterCount() {
    var textarea = document.getElementById("post_text");
    var charCounter = document.getElementById("char_counter");
    var postButton = document.getElementById("post_button");
    var charLimit = 250;

    var charCount = textarea.value.length;

    charCounter.textContent = "Character count: " + charCount;

     if (charCount === 0) {
        postButton.disabled = true;
    } else if (charCount > charLimit) {
        charCounter.classList.add("char-limit-exceeded");
        postButton.disabled = true;
    } else {
        charCounter.classList.remove("char-limit-exceeded");
        postButton.disabled = false;
    }
}

// Attach the event listener to the textarea
var textarea = document.getElementById("post_text");
textarea.addEventListener("input", updateCharacterCount);

// Update the character count initially
updateCharacterCount();