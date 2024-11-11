document.addEventListener('DOMContentLoaded', function () {
    const header= `
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
        <h1>Khám phá những danh lam thắng cảnh tuyệt đẹp</h1>
        <section class="destinations">
            <a href="#" class="article">
                <img src="../../../public/image/NinhBinh.jpeg" alt="provinces">
                <h3 style= "text-align: center">Tràng An - Di sản văn hóa UNESCO đậm giá trị văn hóa và lịch sử dân tộc.</h3>
            </a>
            <a href="#" class="article">
                <img src="../../../public/image/Hue.jpeg" alt="provinces">
                <h3 style= "text-align: center">Lăng Khải Định Huế - đỉnh cao kiến trúc lăng tẩm thời Nguyễn.</h3>
            </a>
            <a href="#" class="article">
                <img src="../../../public/image/QB.jpg" alt="provinces">
                <h3 style= "text-align: center">Sơn Đoòng - Hành trình thám hiểm hang động lớn nhất thế giới</h3>
            </a>
        </section>
    </section>
    `;
    document.body.insertAdjacentHTML('afterbegin', header);
});
