document.addEventListener('DOMContentLoaded', function () {
    const sidebar = `
        <div class="sidebar">
            <img class = "logo" src ="../../../public/image/logo_colored.png"/>

            <ul class="main-menu">
                <li><a href="admin.html"><span class="icon"><ion-icon name="home-outline"></ion-icon></span> Trang chủ</a></li>
                <li class="submenu">
                    <a href="customer_management.html"><ion-icon name="people-outline"></ion-icon> Quản lý người dùng</a>
                </li>
                <li class="submenu">
                    <a href="post_management.html"><ion-icon name="server-outline"></ion-icon> Quản lý post</a>
                </li>
                <li class="submenu">
                    <a href="blog_management.html"><ion-icon name="newspaper-outline"></ion-icon> Quản lý blog</a>
                </li>
                <li class="submenu">
                    <a href="province_management.html"><ion-icon name="diamond-outline"></ion-icon> Quản lý Tỉnh/Thành phố</a>
                </li>
                <li><a href="statistical.html"><span class="icon"><ion-icon name="analytics"></ion-icon></span> Thống kê</a></li>               
                <li class="submenu">
                    <a href="#" onclick="logout()"><ion-icon name="log-out-outline"></ion-icon> Đăng xuất</a>
                </li>
            </ul>
        </div>

        <!-- Nút Toggle Sidebar -->
        <div class="toggle-sidebar" onclick="toggleSidebar()">☰</div>
    `;
    document.body.insertAdjacentHTML('afterbegin', sidebar);

    if (window.innerWidth <= 768) {
        document.getElementById('sidebar').style.width = '0';
    }
});

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');

    if (sidebar.style.transform === 'translateX(0px)') {
        sidebar.style.transform = 'translateX(-100%)'; 
    } else {
        sidebar.style.transform = 'translateX(0)';
    }
}
