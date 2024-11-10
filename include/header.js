document.addEventListener('DOMContentLoaded', function () {
    const header= `
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
                <img src="../../../public/image/NinhBinh.jpeg" alt="provinces">
                <h3>Why you should reconsider The Inca Trail, Peru Trip</h3>
            </a>
            <a href="#" class="article">
                <img src="../../../public/image/Hue.jpeg" alt="provinces">
                <h3>The Hidden Powers of The Northern Lights, Iceland</h3>
            </a>
            <a href="#" class="article">
                <img src="../../../public/image/QB.jpg" alt="provinces">
                <h3>10 Facts you didn't know about The Blue Hole, Belize</h3>
            </a>
        </section>
    </section>
    `;
    document.body.insertAdjacentHTML('afterbegin', header);
});
