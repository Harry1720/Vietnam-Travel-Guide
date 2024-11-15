document.addEventListener('DOMContentLoaded', function () {
    const footer = `
    <footer>
        <div class="footer_logo">
        <img class="footer_logo_img" src="../../../public/image/logo.png" alt="Logo"/>

        </div>
        <h1 class="footer_name">Cẩm nang du lịch Việt Nam</h1>
        <div class="nav_footer_menu">
            <ul>
                <li><a href="../blogger/home.php">Trang chủ</a></li>
                <li><a href="../blogger/province.php">Tỉnh Thành</a></li>
                <li><a href="../blogger/storiesList.php">Blogs</a></li>
                <li><a href="../blogger/WriteReview.php">Viết Blog</a></li>
            </ul>
        </div>
        <div class="bottom_text">
            <h4 class="copyright_text">Copyright © 2024</h4>
        </div>
    </footer>
    `;
    document.body.insertAdjacentHTML('beforeend', footer);
});
