document.addEventListener('DOMContentLoaded', async function () {
    try {     
        const response = await fetch(`../../FunctionOfActor/admin/Notifications.php`);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const rawData = await response.text();
        
        let data;
        try {
            data = JSON.parse(rawData);
        } catch (parseError) {
            console.error('JSON parse error:', parseError);
            throw new Error('Invalid JSON response');
        }

        // Update form fields
        document.getElementById('notifications_count').textContent = data.Count;
        
    } catch (error) {
        console.error('Error in editUser function:', error);
    }
});