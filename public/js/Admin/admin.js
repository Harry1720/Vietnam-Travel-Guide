document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('unlock_user').addEventListener('click', function(event) {
        event.preventDefault();

        const updateButton = document.getElementById('Update_user');
        const editButton = document.getElementById('unlock_user');

        updateButton.style.display = 'inline-block';
        editButton.style.display = 'none';

        // Bỏ khóa các trường để chỉnh sửa
        document.getElementById('name').disabled = false;
        document.getElementById('address').disabled = false;
        document.getElementById('email1').disabled = false;
        document.getElementById('genderSelect').disabled = false;
    });
});