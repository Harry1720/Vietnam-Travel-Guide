document.addEventListener('DOMContentLoaded', async function () {
    try {     
        const response = await fetch(`../../FunctionOfActor/admin/Notifications.php`);
        console.log('Raw response:', response);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const rawData = await response.text();
        
        let data;
        try {
            data = JSON.parse(rawData); // Thử parse JSON
            console.log('Parsed postDetail data:', data);
        } catch (parseError) {
            console.error('JSON parse error:', parseError);
            console.log('Failed to parse response:', rawData);
            throw new Error('Invalid JSON response');
        }

        // Update form fields
        document.getElementById('notifications_count').textContent = data.Count;
        
    } catch (error) {
        console.error('Error in editUser function:', error);
        alert('Error loading user data. Please check console for details.');
    }
});