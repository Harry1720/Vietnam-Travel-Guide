document.addEventListener('DOMContentLoaded', function() {
    // Date Picker Logic
    const datePickerButton = document.getElementById('datePickerButton');
    const popup = document.getElementById('popup');
    const startDateInput = document.getElementById('startDate');
    const endDateInput = document.getElementById('endDate');
    const cancelBtn = document.getElementById('cancelBtn');
    const applyBtn = document.getElementById('applyBtn');
    const dateRangeText = document.getElementById('dateRangeText');

    function formatDate(date) {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return new Date(date).toLocaleDateString('en-US', options);
    }

    datePickerButton.addEventListener('click', () => {
        popup.classList.toggle('show');
    });

    document.addEventListener('click', (e) => {
        if (!datePickerButton.contains(e.target) && !popup.contains(e.target)) {
            popup.classList.remove('show');
        }
    });

    cancelBtn.addEventListener('click', () => {
        popup.classList.remove('show');
    });

    applyBtn.addEventListener('click', () => {
        const startDate = formatDate(startDateInput.value);
        const endDate = formatDate(endDateInput.value);
        dateRangeText.textContent = `${startDate} - ${endDate}`;
        popup.classList.remove('show');
    });

    // Graph Logic
    const ctx = document.getElementById('growthChart').getContext('2d');
    const growthChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: '2024',
                data: [6.8, 7.1, 7.3, 7.5, 7.8, 8.0, 8.2, 8.4, 8.6, 8.8, 9.0, 9.2],
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            },
            {
                label: '2023',
                data: [4.2, 4.5, 4.8, 5.1, 5.4, 5.7, 6.0, 6.3, 6.6, 6.9, 7.2, 7.5],
                borderColor: 'rgb(255, 99, 132)',
                tension: 0.1
            },
            {
                label: '2022',
                data: [2.1, 2.4, 2.8, 3.2, 3.6, 4.0, 4.4, 4.8, 5.2, 5.6, 6.0, 6.4],
                borderColor: 'rgb(54, 162, 235)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Followers (M)'
                    }
                }
            }
        }
    });
})