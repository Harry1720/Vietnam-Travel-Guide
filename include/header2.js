document.addEventListener('DOMContentLoaded', function () {
    const header2 = `
    <header class="header">
        <div class="logo">
            <img src="../../../public/image/logo.png" alt="Logo">
        </div>
        <nav class="nav">
            <a href = "home.html">Home</a>
            <a href="">Provinces</a>
            <a href="storiesList.html">Blogs</a>
            <a href="WriteReview.php">Write Blog</a>
        </nav>
        <nav class="sub_nav">
            <a href="../createAccount.html">Sign Up</a>
            <a href="../login.html" class="btn-login">Login</a>
        </nav>
    </header>
    <section class="hero">
        <h1>Discover New Places and Create Unforgettable Memories</h1>
        <section class="destinations">
            <a href="#" class="article">
                <img src="../../../public/image/province.jpg" alt="provinces">
            </a>

        </section>
    </section>
    `;
    document.body.insertAdjacentHTML('afterbegin', header2);
});
