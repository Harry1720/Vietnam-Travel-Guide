document.addEventListener('DOMContentLoaded', function () {
    const navbar = `
        <div class="navbar">
            <div class="navbar__info">
            </div>
            <div class="navbar__cta">
                <div class="navbar__hello">
                    <ion-icon name="notifications-outline"></ion-icon>
                    <span id="notifications_count">Loading...</span> Bài Viết Chưa Được Duyệt
                </div>
                <div class="navbar__hello">
                    <ion-icon name="settings-outline"></ion-icon> Cài Đặt
                </div>
                <div class="navbar__background-icon">
                    <img class="image-user" src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-portrait-176256935.jpg" alt="Avatar">
                    <div class="dropdown-menu">
                        <button id="openpopup_1">Đổi mật khẩu</button>
                    </div>
                    <div class="navbar__hello near-img">
                        <p> Xin chào</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-separator"></div>

        <div id="popup1_Overlay" class="overlay">
            <div class="popup1content">
                <ion-icon name="close-outline" class="popup1close" id="closepopup-1"></ion-icon>
                <div class="wrapper1">
                    <form id="pass-form" enctype="multipart/form-data">
                        <div class="field1">
                            <label for="current-password">Mật khẩu hiện tại</label>
                            <input type="password" id="current-password" placeholder="Nhập mật khẩu hiện tại">
                        </div>
                        <div class="field1">
                            <label for="new-password">Mật khẩu mới</label>
                            <input type="password" id="new-password" placeholder="Nhập mật khẩu mới">
                        </div>
                        <div class="field1">
                            <label for="confirm-password">Xác nhận mật khẩu mới</label>
                            <input type="password" id="confirm-password" placeholder="Xác nhận mật khẩu mới">
                        </div>
                        <div class="button">
                            <input id="save_Button" type="submit" class="save" onclick="submitChangePassword()" value="Lưu"></input>
                            <input id="cancel_Button" type="button" class="cancel" onclick="closeChangePasswordForm()" value="Hủy"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    `;
    document.body.insertAdjacentHTML('afterbegin', navbar);

    const postForm = document.getElementById("pass-form");
    const resetFormState = () => {
        postForm.reset();
    };

    document.getElementById('openpopup_1').addEventListener('click', () => {
        // postForm.reset();
        popup1_Overlay.style.display = 'flex';
        resetFormState();
    });

    document.getElementById('closepopup-1').addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
            popup1_Overlay.style.display = 'none';
        }
    });

    document.getElementById('cancel_Button').addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
            popup1_Overlay.style.display = 'none';
        }
    });

    window.addEventListener('click', (event) => {
        if (event.target === popup1_Overlay) {
            if(confirm("Xác Nhận Hủy?")){
                popup1_Overlay.style.display = 'none';
            }
        }
    });

});


