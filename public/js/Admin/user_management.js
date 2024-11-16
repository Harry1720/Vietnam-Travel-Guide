document.addEventListener('DOMContentLoaded', () => {
    const customerForm = document.getElementById("user-form");
    const searchInput = document.querySelector('.search-bar');
    const popup1Overlay = document.getElementById('popup1Overlay');
    const popup2Overlay = document.getElementById('popup2Overlay');

    // Event for Search Input
    searchInput.addEventListener('input', () => {
        const searchText = searchInput.value.trim().toLowerCase();
        const rows = document.querySelectorAll('#customer-table-body tr');

        rows.forEach(row => {
            const customerName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            row.style.display = customerName.includes(searchText) ? 'table-row' : 'none';
        });

        toggleIcon();
    });

    // Toggle Search Icon based on Input
    function toggleIcon() {
        const searchIcon = document.querySelector('.search-icon');
        searchIcon.classList.toggle('hidden', searchInput.value.trim() !== '');
    }

    // Reset form on popup open
    const resetFormState = () => {
        customerForm.reset();
    };

    // Open popup for adding a new user
    document.getElementById('openpopup1')?.addEventListener('click', () => {
        popup1Overlay.style.display = 'flex';
        resetFormState();
    });

    // Close popup on click for both popups
    document.querySelectorAll('.popup1-close').forEach(closeBtn => {
        closeBtn.addEventListener('click', (event) => {
            event.target.closest('.popup1-overlay').style.display = 'none';
        });
    });

    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const eyeIcon = this.querySelector('ion-icon');
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        eyeIcon.name = passwordField.type === 'password' ? 'eye-off-outline' : 'eye-outline';
    });

    // Setting form mode for editing
    function setFormMode(isEditMode) {
        const passwordField = document.getElementById('password1');
        const togglePasswordCheckbox = document.getElementById('togglePassword');

        if (passwordField && togglePasswordCheckbox) {
            passwordField.disabled = isEditMode;
            togglePasswordCheckbox.disabled = isEditMode;
        }
    }

    const isEditMode = window.location.href.includes('edit');
    setFormMode(isEditMode);

    // Function for deleting by ID
    window.deleteID = function (id) {
        console.log(id);
        document.getElementById('deleteID').value = id;
    }

    // Function for editing user data
    window.editUser = async function (userId) {
        try {
            console.log('Fetching user data for ID:', userId);
            const response = await fetch(`../../FunctionOfActor/admin/getUser.php?editId=${userId}`);
            console.log('Raw response:', response);

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            const rawData = await response.text();

            let userData;
            try {
                userData = JSON.parse(rawData);
            } catch (parseError) {
                console.error('JSON parse error:', parseError);
                throw new Error('Invalid JSON response');
            }

            // Update form fields
            document.getElementById('userName1').value = userData.userName;
            document.getElementById('email1').value = userData.email;
            document.getElementById('password1').value = userData.password;
            document.getElementById('address1').value = userData.address;
            document.getElementById('role1').value = userData.role;
            document.getElementById('gender1').value = userData.gender;
            document.getElementById('userID').value = userData.userID;

            // Show edit popup
            popup2Overlay.style.display = 'flex';
        } catch (error) {
            console.error('Error in editUser function:', error);
        }
    };
});
