document.addEventListener('DOMContentLoaded', function (){
    const backButton = document.getElementById('back-btn');

    backButton.addEventListener('click', function() {
        window.location.href = "/src/Views/login.html";
    });
});
