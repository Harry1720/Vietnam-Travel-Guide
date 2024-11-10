<?php
    include_once "CloudinaryUploader.php";

    // Check if file is uploaded
    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
        // Get the file's temporary path
        $fileTmpPath = $_FILES['fileToUpload']['tmp_name'];

        // Initialize the Cloudinary uploader
        $uploader = new CloudinaryUploader();

        // Upload the file and get the response (URL or false)
        $result = $uploader->upload($fileTmpPath);

        if ($result) {
            echo "File uploaded successfully: " . $result;
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "No file uploaded or there was an error.";
    }
?>
