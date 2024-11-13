document.addEventListener('DOMContentLoaded', async function () {
    try {
        const response = await fetch('../../FunctionOfActor/blogger/checkAuth.php');

        if (!response.ok) {
            throw new Error('Failed to fetch session data. Status: ' + response.status);
        }

        const data = await response.json();
        console.log(data);

        const header = `
        <header class="header">
            <div class="logo">
                <img src="../../../public/image/logo_colored.png" alt="Logo">
            </div>
            <nav class="nav">
                <a href="home.php">Trang chủ</a>
                <a href="province.php">Tỉnh Thành</a>
                <a href="storiesList.html">Blogs</a>
                <a href="WriteReview.php">Viết Blog</a>
            </nav>
            <nav class="sub_nav">
                ${data.loggedIn ? 
                    `<a href="../../FunctionOfActor/both/logout.php" class="btn-logout">Đăng xuất</a>` : 
                    `<a href="../createAccount.html" class="btn-signup">Đăng ký</a>
                    <a href="../login.html" class="btn-login">Đăng nhập</a>`}
            </nav>
        </header>
        <section class="hero">
            <h1>Khám phá những danh lam thắng cảnh tuyệt đẹp</h1>
            <section class="destinations">
                <a href="#" class="article">
                    <img src="../../../public/image/NinhBinh.jpeg" alt="provinces">
                    <h3 style="text-align: center">Tràng An - Di sản văn hóa UNESCO đậm giá trị văn hóa và lịch sử dân tộc.</h3>
                </a>
                <a href="#" class="article">
                    <img src="../../../public/image/Hue.jpeg" alt="provinces">
                    <h3 style="text-align: center">Lăng Khải Định Huế - đỉnh cao kiến trúc lăng tẩm thời Nguyễn.</h3>
                </a>
                <a href="#" class="article">
                    <img src="../../../public/image/QB.jpg" alt="provinces">
                    <h3 style="text-align: center">Sơn Đoòng - Hành trình thám hiểm hang động lớn nhất thế giới</h3>
                </a>
            </section>
        </section>
        `;

        // Thêm header vào trang
        document.body.insertAdjacentHTML('afterbegin', header);
    } catch (error) {
        console.error('Error fetching session data:', error);
        alert('Không thể tải trạng thái đăng nhập. Vui lòng thử lại sau.');
    }
    const header = document.querySelector('.header');
    const heroSection = document.querySelector('.hero');
    
    function toggleHeaderBackground() {
        // Get the position of the bottom of the hero image
        const heroBottom = heroSection.getBoundingClientRect().bottom;
        
        // Toggle the 'scrolled' class based on scroll position
        if (window.scrollY >= heroBottom) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }

    // Attach the scroll event to toggle the header background
    window.addEventListener('scroll', toggleHeaderBackground);
});
