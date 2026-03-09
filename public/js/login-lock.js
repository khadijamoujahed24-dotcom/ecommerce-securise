document.addEventListener("DOMContentLoaded", function () {

    const message = document.getElementById("throttle-message");
    if (!message) return;

    const text = message.innerText;

    
    const match = text.match(/(\d+)/);
    if (!match) return;

    let seconds = parseInt(match[1]);

    const button = document.querySelector("button[type='submit']");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");

    button.disabled = true;
    emailInput.disabled = true;
    passwordInput.disabled = true;

    const interval = setInterval(() => {
        seconds--;

        message.innerText = "Too many login attempts. Please try again in " + seconds + " seconds.";

        if (seconds <= 0) {
            clearInterval(interval);
            message.innerText = "You can try again now.";

            button.disabled = false;
            emailInput.disabled = false;
            passwordInput.disabled = false;
        }

    }, 1000);

});