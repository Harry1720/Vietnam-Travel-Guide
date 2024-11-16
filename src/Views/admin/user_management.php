<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý khách hàng</title>
    <link rel="stylesheet" href="../../../public/css/Admin/user_management.css">
    <link rel="stylesheet" href="../../../public/css/sidebar.css">
    <link rel="stylesheet" href="../../../public/css/navbar.css">
    <!--JS-->
    <script src="../../../include/sidebar.js"></script>
    <script src="../../../include/navbar.js"></script>
    <script src="../../../public/js/Admin/Notifications.js"></script>
    <script src="../../../public/js/Admin/popup.js"></script>
    <script src="../../../public/js/Admin/user_management.js"></script>
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bcryptjs/2.4.3/bcrypt.min.js"></script>
</head>

<body>
    <?php
        include_once "../../Controllers/adminController.php";
        include_once "../../Controllers/authController.php";
        include_once "../../Controllers/bothController.php";
        
        $auth = new AuthController();
        $auth->checkAdmin();  
            
        $adController = new AdminController();
        $bothcontroller = new bothController();

        $totalUser = $adController->TotalUsers();
        $limit= 10;
        if (isset($_GET['page'])) { $page = $_GET['page'];} 
        else { $page = 1; }
        $Start = ($page - 1) * $limit;
        $stt = $Start+1;
        $countPage = ceil($totalUser['TotalUsers']/$limit);
        $provinces = $bothcontroller->getAllProvinces();
        $userOfPage = $adController->getUserOfPage($Start,$limit);
    ?>
    <div class="main-content">
        <div class="customer-management">
            <button class="add-user-btn" id="openpopup1">
                Thêm Người Dùng <ion-icon style="margin-left: 5px;" name="add-circle-outline"></ion-icon>
            </button>

            <div class="search-container">
                <input type="text" placeholder="Nhập họ tên để tìm kiếm..." class="search-bar" oninput="toggleIcon()">
                <ion-icon name="search-outline" class="search-icon"></ion-icon>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Người Dùng</th>
                            <th>Email</th>
                            <th>Giới Tính</th>
                            <th>Địa Chỉ</th>
                            <th>Vai Trò</th>
                            <th>Lựa Chọn</th>
                        </tr>
                    </thead>
                    <tbody id="customer-table-body">
                    <?php
                        if(mysqli_num_rows($userOfPage)>0){
                            while($user = mysqli_fetch_array($userOfPage)){
                                ?>
                                <tr>
                                    <td><?php echo $stt++ ?></td>
                                    <td><?php echo $user['userName'] ?? 'Lỗi Hiển Thị'?></td>
                                    <td><?php echo $user['email'] ?? 'Lỗi Hiển Thị'?></td>
                                    <td><?php echo $user['gender'] ?? 'Lỗi Hiển Thị'?></td>
                                    <td><?php echo $user['provinceName'] ?? 'Lỗi Hiển Thị'?></td>
                                    <td><?php echo $user['role_'] ?? 'Lỗi Hiển Thị'?></td>
                                    <td class="action-btn-frame">
                                        <button class="action-btn edit" id="edit-btn" onclick="editUser(<?php echo $user['userID']?>)">
                                            <ion-icon name="create"></ion-icon>
                                        </button>
                                        <button class="action-btn delete" id="delete-btn" onclick="deleteID(<?php echo $user['userID']?>)">
                                            <ion-icon name="trash"></ion-icon>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <?php
                        for ($i = 1; $i <= $countPage; $i++) {
                            $activeClass = ($i == $page) ? 'active' : '';
                            echo "<a class='page-btn $activeClass' href='?page=$i'>$i</a>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="popup1-overlay" id="popup1Overlay">
        <div class="popup1-content">
            <span class="popup1-close" id="closepopup1">&times;</span>
            <div class="wrapper" id = "addUser">
                <form id="user-form" name="add" method="POST"  enctype="multipart/form-data" action = "../../FunctionOfActor/admin/addUser.php">
                        <div class="field input">
                            <label for="userName">Họ và Tên</label>
                            <input type="text" id="userName" name="userName" placeholder="Nguyễn Văn A" required>
                        </div>

                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="tel" id="email" name="email" placeholder="nguyenvana@gmail.com" required>
                    </div>

                    <div class="field input">
                        <label for="address">Tỉnh/Thành Phố</label>
                        <select id="address" name="address">
                            <?php foreach ($provinces as $province) { ?>
                                <option value="<?php echo $province['provinceID']; ?>"><?php echo $province['provinceName']; ?></option>
                            <?php }?>
                        </select>
                    </div>

                    <div class="field input">
                        <label for="password">Mật khẩu</label>
                        <div style="position: relative;">
                            <input type="password" id="password" name="password" required>
                            <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                <ion-icon style = "color: #35679C" name="eye-outline"></ion-icon>
                            </span>
                        </div>
                    </div>
                    <div class="field input" style="margin-bottom: 20px; display: flex; padding-top: 10px">
                        <label id="label-role" for="role" >Chức Vụ</label>
                        <select id="role" name="role">
                            <option value="Admin">Admin</option>
                            <option value="Blogger">Blogger</option>
                        </select>
                        <label id="label-gender" for="gender">Giới Tính</label>
                        <select id="gender" name="gender">
                            <option value="Male">Nam</option>
                            <option value="FeMale">Nữ</option>
                        </select>
                    </div>
                    <div class="button">
                        <input type="submit" value="Tạo" class="save" id="saveButton">
                        <input type="button" value="Hủy" class="cancel" id="cancelButton">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="popup1-overlay" id="popup2Overlay">
        <div class="popup1-content">
            <span class="popup1-close" id="closepopup2">&times;</span>
            <div class="wrapper" id = "updateUser">
                <form id="user-update-form" name="update" method="POST" enctype="multipart/form-data" action="../../FunctionOfActor/admin/updateUser.php">
                    <input type="hidden" name="userID" id="userID" value="">
                        <div class="field input">
                            <label for="userName1">Họ và Tên</label>
                            <input type="text" id="userName1" name="userName1" required>
                        </div>
                    <div class="field input">
                        <label for="email1">Email</label>
                        <input type="tel" id="email1" name="email1" required disabled>
                    </div>
                    <div class="field input">
                        <label for="address1">Tỉnh/Thành Phố</label>
                        <select id="address1" name="address1">
                            <?php foreach ($provinces as $province) { ?>
                                <option value="<?php echo $province['provinceID']; ?>"><?php echo $province['provinceName']; ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="field input">
                        <label for="password1">Mật khẩu</label>
                        <div style="position: relative;">
                            <input type="password" id="password1" name="password1"  required>
                            <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                <ion-icon style = "color: #35679C" name="eye-outline"></ion-icon>
                            </span>
                        </div>
                    </div>
                    <div class="field input" style="margin-bottom: 20px; display: flex; padding-top: 10px">
                        <label for="role1" >Chức Vụ</label>
                        <select id="role1" name="role1" disabled>
                            <option value="Admin">Admin</option>
                            <option value="Blogger">Blogger</option>
                        </select>
                        <label for="gender1">Giới Tính</label>
                        <select id="gender1" name="gender1">
                            <option value="Male">Nam</option>
                            <option value="FeMale">Nữ</option>
                        </select>
                    </div>
                    <div class="button">
                        <input type="submit" value="Cập nhật" class="save" id="saveButton2">
                        <input type="button" value="Hủy" class="cancel" id="cancelButton2">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="popup" class="popup-overlay">
        <div class="popup-content">
            <form action="../../FunctionOfActor/admin/deleteUser.php" method= "POST" name ="delete" id ="delete">
                <p>Bạn có chắc chắn xóa người dùng đến này?</p>
                <input type="hidden" id="deleteID" name="deleteID">
                <input type="submit" id="yes-btn" class="popup-btn" value="Có">
                <!-- <button id="yes-btn" class="popup-btn">Có</button> -->
                <button id="no-btn" class="popup-btn">Không</button>                
            </form>
        </div>
    </div>
</body>
</html>