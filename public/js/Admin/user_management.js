document.addEventListener('DOMContentLoaded', () => {
    const customerForm = document.getElementById("user-form");
    const searchInput = document.querySelector('.search-bar');

    searchInput.addEventListener('input', () => {
        const searchText = searchInput.value.trim().toLowerCase();
        const rows = document.querySelectorAll('#customer-table-body tr');

        rows.forEach(row => {
            const customerName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            row.style.display = customerName.includes(searchText) ? 'table-row' : 'none';
        });
    });

    const resetFormState = () => {
        customerForm.reset();
    };


    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const eyeIcon = this.querySelector('ion-icon');
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        eyeIcon.name = passwordField.type === 'password' ? 'eye-off-outline' : 'eye-outline';
    });
});

function deleteID(id){
    console.log(id);
    document.getElementById('deleteID').value=id;
}

async function editUser(userId) {
    try {
        console.log('Fetching user data for ID:', userId);
        
        const response = await fetch(`../../FunctionOfActor/admin/getUser.php?editId=${userId}`);
        console.log('Raw response:', response);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const rawData = await response.text();
        
        let userData;
        try {
            userData = JSON.parse(rawData); // Thử parse JSON
            console.log('Parsed user data:', userData);
        } catch (parseError) {
            console.error('JSON parse error:', parseError);
            console.log('Failed to parse response:', rawData);
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
        
    } catch (error) {
        console.error('Error in editUser function:', error);
        alert('Error loading user data. Please check console for details.');
    }
}
// Function to set the form mode
function setFormMode(isEditMode) {
    const passwordField = document.getElementById('password');
    const togglePasswordCheckbox = document.getElementById('togglePassword');

    if (isEditMode) {
        // Disable the password field for editing mode
        passwordField.disabled = true;
        togglePasswordCheckbox.disabled = true; // Disable the toggle checkbox as well
    } else {
        // Enable the password field for adding new user mode
        passwordField.disabled = false;
        togglePasswordCheckbox.disabled = false; // Enable the toggle checkbox
    }
}

const isEditMode = window.location.href.includes('edit');

// Set the form mode accordingly
setFormMode(isEditMode);

// Toggle Password Visibility
document.getElementById('togglePassword').addEventListener('change', function () {
    const passwordField = document.getElementById('password');
    passwordField.type = this.checked ? 'text' : 'password';
});

function toggleIcon() {
    const searchInput = document.querySelector('.search-bar');
    const searchIcon = document.querySelector('.search-icon');
    
    if (searchInput.value.trim() !== '') {
        searchIcon.classList.add('hidden');
    } else {
        searchIcon.classList.remove('hidden');
    }
}