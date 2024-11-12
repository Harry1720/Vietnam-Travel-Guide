document.addEventListener('DOMContentLoaded', function () {
    const header2 = `
    <header class="header">
        <div class="logo">
            <img src="../../../public/image/logo_colored.png" alt="Logo">
        </div>
        <nav class="nav">
            <a href="../blogger/home.php">Trang chủ</a>
            <a href="../admin/province.php">Tỉnh Thành</a>
            <a href="../blogger/storiesList.html">Blogs</a>
            <a href="../blogger/WriteReview.php">Viết Blog</a>
        </nav>
        <nav class="sub_nav">
            <a href="../createAccount.html" class="btn-register">Đăng ký</a>
            <a href="../login.html" class="btn-login">Đăng nhập</a>
        </nav>
    </header>
    <section class="hero">
        <h1>Khám phá những vùng đất mới và tạo những kỉ niệm đáng nhớ</h1>
        <section class="destinations">
            <a href="#" class="article">
                <img src="../../../public/image/lung-cu-ha-giang.jpg" alt="provinces">
            </a>
        </section>
    </section>
    `;
    document.body.insertAdjacentHTML('afterbegin', header2);

    const header = document.querySelector('.header');
    const heroImage = document.querySelector('.hero img');
    
    function toggleHeaderBackground() {
        // Get the position of the bottom of the hero image
        const heroBottom = heroImage.getBoundingClientRect().bottom;
        
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