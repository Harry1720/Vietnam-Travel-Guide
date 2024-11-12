document.addEventListener('DOMContentLoaded', () => {
    // Fetch and display top-selling products
    fetchTopSellingProducts();
    // Fetch and display total products sold
    fetchTotalProductsSold();
    // Fetch and display total orders for the current day
    fetchTotalOrdersToday();
    // Fetch and display revenue by month and year
    fetchRevenueByMonthAndYear();
    // Fetch and display total orders by year
    fetchTotalOrdersByYear();
    // Fetch and display customer data by gender
    fetchCustomerDataByGender();
    // Fetch and display total customers
    fetchTotalCustomers();
    fetchTotalOrder();
    fetchTotalRevenueChart()
    fetchTopCustomerSelling()
    // Add event listeners for month and year select elements
    document.getElementById('select-month').addEventListener('change', updateData);
    document.getElementById('select-year').addEventListener('change', updateData);
});

function updateData() {
    fetchRevenueByMonthAndYear();
    fetchTotalOrdersByYear();
    fetchTotalRevenueChart()
}



// Dữ liệu giả lập
const data = {
    day: {
        views: [10, 20, 30, 40, 50, 60, 70],
        comments: [5, 15, 25, 35, 45, 55, 65],
        posts: [2, 4, 6, 8, 10, 12, 14],
        labels: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật']
    },
    month: {
        views: [300, 400, 500, 600, 700, 800, 900],
        comments: [100, 150, 200, 250, 300, 350, 400],
        posts: [20, 25, 30, 35, 40, 45, 50],
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7']
    },
    year: {
        views: [5000, 6000, 7000, 8000, 9000, 10000, 11000],
        comments: [1500, 2000, 2500, 3000, 3500, 4000, 4500],
        posts: [100, 150, 200, 250, 300, 350, 400],
        labels: ['2018', '2019', '2020', '2021', '2022', '2023', '2024']
    }
};

// Lấy context của canvas
document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById('customer-gender-chart');
    if (!canvas) {
        console.error("Không tìm thấy phần tử canvas với ID 'customer-gender-chart'.");
        return;
    }

    const ctx = canvas.getContext('2d');
    let chart;

    // Hàm cập nhật biểu đồ
    function updateChart(xAxis = 'month', yAxis = 'views') {
        if (!data[xAxis] || !data[xAxis][yAxis]) {
            console.error("Dữ liệu không hợp lệ cho xAxis:", xAxis, "yAxis:", yAxis);
            return;
        }

        const chartData = data[xAxis][yAxis];
        const chartLabels = data[xAxis].labels;

        // Nếu biểu đồ đã tồn tại, cập nhật dữ liệu
        if (chart) {
            chart.data.labels = chartLabels;
            chart.data.datasets[0].data = chartData;
            chart.data.datasets[0].label = yAxis.charAt(0).toUpperCase() + yAxis.slice(1);
            chart.update();
        } else {
            // Tạo biểu đồ mới nếu chưa có
            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: yAxis.charAt(0).toUpperCase() + yAxis.slice(1),
                        data: chartData,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Thời gian'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: yAxis
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }

    // Lắng nghe sự kiện thay đổi từ các ô chọn
    const xAxisSelect = document.getElementById('x-axis-select');
    const yAxisSelect = document.getElementById('y-axis-select');

    if (xAxisSelect && yAxisSelect) {
        xAxisSelect.addEventListener('change', () => {
            const xAxis = xAxisSelect.value;
            const yAxis = yAxisSelect.value;
            updateChart(xAxis, yAxis);
        });

        yAxisSelect.addEventListener('change', () => {
            const xAxis = xAxisSelect.value;
            const yAxis = yAxisSelect.value;
            updateChart(xAxis, yAxis);
        });
    } else {
        console.error("Không tìm thấy phần tử select với ID 'x-axis-select' hoặc 'y-axis-select'.");
    }

    // Khởi tạo biểu đồ mặc định
    updateChart();
});


// Dữ liệu mẫu cho bảng "Bài đăng hàng đầu"
const topPostsData = [
    { index: 1, name: 'Hướng dẫn lập trình JavaScript', views: 1500, comments: 120 },
    { index: 2, name: 'Cách học Python hiệu quả', views: 1300, comments: 95 },
    { index: 3, name: 'Những mẹo viết HTML hay', views: 1100, comments: 80 },
    { index: 4, name: 'Hướng dẫn CSS Flexbox', views: 900, comments: 70 },
    { index: 5, name: 'Phân tích dữ liệu với SQL', views: 850, comments: 60 }
];

// Hàm hiển thị dữ liệu vào bảng
function renderTopPosts() {
    const list = document.getElementById('top-products-list');
    
    if (!list) {
        console.error('Không tìm thấy phần tử với id "top-products-list"');
        return;
    }

    // Xóa các mục hiện tại (nếu có)
    list.innerHTML = `
        <li class="product-header">
            <div class="product-index">#</div>
            <div class="product-name">Tên bài đăng</div>
            <div class="product-views">Lượt xem</div>
            <div class="product-comments">Bình luận</div>
        </li>
    `;

    // Thêm dữ liệu vào bảng
    topPostsData.forEach(post => {
        const item = document.createElement('li');
        item.classList.add('product-item');
        item.innerHTML = `
            <div class="product-index">${post.index}</div>
            <div class="product-name">${post.name}</div>
            <div class="product-views">${post.views}</div>
            <div class="product-comments">${post.comments}</div>
        `;
        list.appendChild(item);
    });
}

// Đảm bảo DOM đã được tải xong trước khi gọi hàm renderTopPosts
document.addEventListener('DOMContentLoaded', function() {
    renderTopPosts();
});

// Hàm giả lập fetch API để kiểm tra dữ liệu
function fetchData(url) {
    return fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Lỗi khi tải dữ liệu từ: ${url}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Dữ liệu trả về:', data);
        })
        .catch(error => {
            console.error('Lỗi khi fetch dữ liệu:', error);
        });
}

// Ví dụ gọi API giả lập
fetchData('api/top-selling-products');
fetchData('api/total-products-sold');
