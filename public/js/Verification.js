document.addEventListener('DOMContentLoaded',function(){
    const codeBoxes = document.querySelectorAll('.code-box');

        codeBoxes.forEach((box, index) => {
            box.addEventListener('input', () => {
                // Chuyển đến ô tiếp theo chỉ nếu ô hiện tại không rỗng
                if (box.value.length >= 1) {
                    if (index < codeBoxes.length - 1) {
                        codeBoxes[index + 1].focus();
                    }
                }
            });
            

            box.addEventListener('keydown', (event) => {
                // Chuyển về ô trước nếu phím Backspace được nhấn và ô hiện tại rỗng
                if (event.key === 'Backspace' && box.value.length === 0 && index > 0) {
                    codeBoxes[index - 1].focus();
                }
            });
        });

        // Verify when Enter is pressed
        document.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            verifyButton.click();
        }
  
        });

})

// JavaScript Countdown Logic
let countdownElement = document.getElementById("countdown");
let resendButton = document.getElementById("resendButton");
let timer = 60; // Countdown time in seconds

function startCountdown() {
    let countdownInterval = setInterval(() => {
        timer--;
        countdownElement.textContent = timer;

        // When countdown ends
        if (timer <= 0) {
            clearInterval(countdownInterval);
            countdownElement.parentElement.style.display = "none"; // Hide the timer
            resendButton.style.display = "block"; // Show the resend button
        }
    }, 1000);
}

// Start the countdown on page load
document.addEventListener("DOMContentLoaded", startCountdown);

// Handle resend button click
resendButton.addEventListener("click", () => {
    // Reset timer and UI
    timer = 60;
    countdownElement.textContent = timer;
    countdownElement.parentElement.style.display = "block"; // Show the timer again
    resendButton.style.display = "none"; // Hide the resend button
    startCountdown(); // Restart the countdown
});
