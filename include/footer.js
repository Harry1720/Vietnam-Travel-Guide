document.addEventListener('DOMContentLoaded', function () {
    const footer = `
    <footer>
        <div class="footer_logo">
        <img class="footer_logo_img" src = "../../../public/image/logo.png" alt="Logo"/>

        </div>
        <h1 class="footer_name">Cẩm nang du lịch Việt Nam</h1>
        <div class="nav_footer_menu">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="">Provinces</a></li>
                <li><a href="storiesList.html">Blogs</a></li>
                <li><a href="WriteReview.php">Write Blog</a></li>
            </ul>
        </div>
        <div class="bottom_text">
            <h4 class="copyright_text">Copyright © 2024</h4>
        </div>
    </footer>
    `;
    document.body.insertAdjacentHTML('beforeend', footer);
});
