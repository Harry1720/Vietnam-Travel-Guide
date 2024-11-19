<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../../public/css/createAccount.css">
    <script src="/public/js/createAccount.js"></script>
</head>
<body>
    <!--  on -->
    <img src="../../public/image/test1.jpg" alt="Không Hiển Thị" id="left-img">

    <div class="create-container">
        <h1>Xin chào! Hãy bắt đầu nào!<img src="https://user-images.githubusercontent.com/1303154/88677602-1635ba80-d120-11ea-84d8-d263ba5fc3c0.gif" width="32px" alt="hi"></h1>
        

        <form class="login-form" method="post" action="../FunctionOfActor/both/createAccount.php">
            <div class = "input-form">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="name" name="username" placeholder="nguyenvana" required>
            </div>
            <div class = "input-form">
                <label for="email">Địa chỉ email</label>
                <input type="email" id="email" name="email" placeholder="nguyena@gmail.com" required>        
            </div>
            <div class="input-form password-container">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nên bao gồm số và ký tự" required>
                <span class="eye-icon" onclick="this.previousElementSibling.type = this.previousElementSibling.type === 'password' ? 'text' : 'password'">
                    👁️‍🗨️ 
                </span>
            </div>            
            <div class="input-form password-container">
                <label for="confirm-password">Xác nhận mật khẩu</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Vui lòng nhập lại mật khẩu" required>
                <span class="eye-icon" onclick="this.previousElementSibling.type = this.previousElementSibling.type === 'password' ? 'text' : 'password'">
                    👁️‍🗨️
                </span>
            </div>
            
            <div class="field input"">
                        <label for="address" style="width: 120px; ">Tỉnh/Thành Phố</label>
                        <select id="address" name="address">
                            <?php foreach ($provinces as $province) { ?>
                                <option value="<?php echo $province['provinceID']; ?>"><?php echo $province['provinceName']; ?></option>
                            <?php }?>
                        </select>
                    </div>
            <div>
            <div class="field input" style="margin-bottom: 10px; ">
                <label for="gender1" style="">Giới Tính</label>
                    <select id="gender1" name="gender1" style=" min-width: 100px; margin-bottom: 10px; ">
                        <option value="Male">Nam</option>
                        <option value="FeMale">Nữ</option>
                    </select>
            </div>
            <div>
                <button class="add-user-btn" id="submit">
                    Đăng Ký <ion-icon style="margin-left: 5px;" name="add-circle-outline"></ion-icon>
                </button>
            </div>
            <div class="login-account">
                Đã có tài khoản? <a href="login.html"><b>Đăng nhập</b></a>
            </div>
        </form>
    </div>
    
</body>
</html>