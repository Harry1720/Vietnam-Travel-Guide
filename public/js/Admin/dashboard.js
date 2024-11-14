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

        // Lấy năm từ startDate và gọi lại hàm cập nhật dữ liệu cho biểu đồ
        const startYear = new Date(startDateInput.value).getFullYear();
        const endYear = new Date(endDateInput.value).getFullYear();

        // Kiểm tra năm được chọn
        if (startYear === endYear) {
            fetchBlogData(startYear);
        } else {
            alert('Vui lòng chọn cùng một năm cho cả khoảng thời gian.');
        }

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
                data: [],
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    function fetchBlogData(year) {
        console.log(year);

        fetch(`../../../src/FunctionOfActor/admin/BlogInYear.php?year=${year}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error(data.error);
                    return;
                }
                // Cập nhật dữ liệu biểu đồ với dữ liệu lấy từ PHP
                growthChart.data.datasets[0].data = data;  // Thay thế bằng dữ liệu thực tế
                growthChart.data.datasets[0].label = `${year}`;
                growthChart.update();  // Vẽ lại biểu đồ
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Mặc định tải dữ liệu cho năm 2023 khi trang được tải
    fetchBlogData(2023);
});
