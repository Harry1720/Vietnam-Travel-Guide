<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write New Review</title>
    <link rel="stylesheet" href="../../../public/css/Blogger/WriteReview.css">
</head>
<body>
    <?php   
        include_once "../../Controllers/bothController.php";
        include_once "../../Controllers/authController.php";

        $controller = new bothController();
        $provinces = $controller->getAllProvinces();
        
        $auth = new AuthController();
        $auth->checkAuth();
    ?>
    <section class="main-section">            
            <div class="flex-container">
                <form action="../../FunctionOfActor/blogger/addBlog.php" method="POST" name = "" enctype="multipart/form-data">
                    <div class="top-places">
                        <h2>Upload Photos for Review</h2>
                        
                        <p>Share the best moments from your travel journey.</p>
                        
                        <div class="review-placeholder">
                            <label for="upload-photos">Upload your photos</label>
                            <input type="file" id="upload-photos" name="photos[]" accept="image/*" multiple>
                        </div>
                        <div id="photo-preview" class="photo-preview"></div>
                    </div>
                    <label for="title">Title of your review</label>
                    <input type="text" id="title" name="title" placeholder="Summarize your Travel Journey">
                    
                    <label for="review">Your review</label>
                    <textarea id="review" name="review" placeholder="A detailed review of your Travel Journey. Travelers will love to know your experience"></textarea>

                    <label for="location">Location</label>
                    <select id="location" name="location" required>
                        <option value="">Chọn tỉnh/thành</option>
                        <?php
                            foreach ($provinces as $province) {
                                echo '<option value="' . $province['provinceID'] . '">' . $province['provinceName'] . '</option>';
                            }
                        ?>
                    </select>
                    
                    <label for="travel-date">When did you travel?</label>
                    <select id="travel-date" name="travel-date">
                        <option>Select One</option>
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                    
                    <button type="submit" class="submit-btn">Submit Review</button>
                </form>
            </div>
        </div>
    </section>

    <script src="/public/js/WriteReview.js"></script>
</body>
</html>
