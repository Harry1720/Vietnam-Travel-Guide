document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('unlock_blogger').addEventListener('click', function(event) {
        event.preventDefault();

        // Bỏ khóa các trường để chỉnh sửa
        document.getElementById('name').disabled = false;
        document.getElementById('address').disabled = false;
        document.getElementById('email').disabled = false;
        document.getElementById('gender').disabled = false;
    });
});

