document.addEventListener('DOMContentLoaded', function() {
    // Date Picker Logic
    const datePickerButton = document.getElementById('datePickerButton');
    const popup = document.getElementById('popup');
    const dateRangeText = document.getElementById('dateRangeText');

    // Lấy năm hiện tại
    const currentYear = new Date().getFullYear();
    const MinYear = 2023;
    const yearSelect = document.getElementById('yearSelect');
    // Thêm các option cho năm từ hiện tại đến 2024
    for (let year = currentYear; year >= MinYear; year--) {
        let option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option);
    }

    // Lắng nghe sự kiện thay đổi năm
    yearSelect.addEventListener('change', () => {
        const selectedYear = parseInt(yearSelect.value, 10);
        fetchBlogData(selectedYear);
    });

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

    // Graph Logic
    const ctx = document.getElementById('growthChart').getContext('2d');
    const growthChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: '',
                data: [],
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.4
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


    const ctx1 = document.getElementById('engagementChart').getContext('2d');
    const topProvince = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: '',
                data: [],
                backgroundColor: [
                    'rgba(75,192,192,0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(231, 74, 59, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(231, 74, 59, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    align: 'center',
                    labels: {
                        boxWidth: 10,
                        padding: 20
                    }
                }
            },
            layout: {
                padding: {
                    left: 10, right: 10, top: 10, bottom: 10
                }
            }
        }
    });
    

    function fetchBlogData(selectedYear) {
        fetch(`../../../src/FunctionOfActor/admin/dataInYear.php?year=${selectedYear}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.error) {
                    console.error(data.error);
                    return;
                }
                // Update growthChart (blogs by month)
                growthChart.data.datasets[0].data = data.blogByMonth; 
                growthChart.data.datasets[0].label = `${selectedYear}`;
                growthChart.update();
    
                 // Update topProvince chart (blogs by province)
                topProvince.data.labels = data.blogByProvince.map(item => item.provinceName);
                topProvince.data.datasets[0].data = data.blogByProvince.map(item => item.blogCount);
                topProvince.data.datasets[0].label = `${selectedYear}`;
                topProvince.update(); 
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }
    

    // Mặc định tải dữ liệu cho năm 2023 khi trang được tải
    fetchBlogData(currentYear);
});
