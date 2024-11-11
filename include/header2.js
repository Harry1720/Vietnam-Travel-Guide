document.addEventListener('DOMContentLoaded', function () {
    const header2 = `
    <header class="header">
        <div class="logo">
            <img src="../../../public/image/logo.png" alt="Logo">
        </div>
        <nav class="nav">
            <a href = "home.html">Trang chủ</a>
            <a href="">Tỉnh Thành</a>
            <a href="storiesList.html">Blogs</a>
            <a href="WriteReview.php">Viết Blog</a>
        </nav>
        <nav class="sub_nav">
            <a href="../createAccount.html">Đăng ký</a>
            <a href="../login.html" class="btn-login">Đăng nhập</a>
        </nav>
    </header>
    <section class="hero">
        <h1>Khám phá những vùng đất mới và tạo những kỉ niệm đáng nhớ</h1>
        <section class="destinations">
            <a href="#" class="article">
                <img src="../../../public/image/province.jpg" alt="provinces">
            </a>

        </section>
    </section>
    `;
    document.body.insertAdjacentHTML('afterbegin', header2);
});
