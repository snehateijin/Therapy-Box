<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#gallery-image').attr('src', e.target.result);
                //$('.text-block').hide();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css" />
<div id="wrapper" class="box">
    <div class="row">
        <div class="container" >
            
            
            <form action="" method="post" enctype="multipart/form-data">
                <label for="upload_file">
                    <img src="images/Plus_button_small.png" id="gallery-image"/>                        
                </label>
                <input id="upload_file" type="file" name="files[]" multiple onchange="readURL(this);" >
                <input type="submit" name="submit" value="UPLOAD">
                
            </form>
            <div class="gallery-container">
                    
            <?php
            include "db_config.php";
// Create database connection
            $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Check connection
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }
            if (isset($_POST['submit'])) {    // Include the database configuration file
                // File upload configuration
                $targetDir = "gallery/";
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

                $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
                if (!empty(array_filter($_FILES['files']['name']))) {
                    foreach ($_FILES['files']['name'] as $key => $val) {
                        // File upload path
                        $fileName = basename($_FILES['files']['name'][$key]);
                        $targetFilePath = $targetDir . $fileName;

                        // Check whether file type is valid
                        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                        if (in_array($fileType, $allowTypes)) {
                            // Upload file to server
                            if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                                // Image db insert sql
                                $insertValuesSQL .= "('" . $fileName . "', NOW()),";
                            } else {
                                $errorUpload .= $_FILES['files']['name'][$key] . ', ';
                            }
                        } else {
                            $errorUploadType .= $_FILES['files']['name'][$key] . ', ';
                        }
                    }

                    if (!empty($insertValuesSQL)) {
                        $insertValuesSQL = trim($insertValuesSQL, ',');
                        // Insert image file name into database
                        $insert = $db->query("INSERT INTO gallery (file_name, uploaded_on) VALUES $insertValuesSQL");
                        if ($insert) {
                            $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . $errorUpload : '';
                            $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . $errorUploadType : '';
                            $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                            $statusMsg = "Files are uploaded successfully." . $errorMsg;
                        } else {
                            $statusMsg = "Sorry, there was an error uploading your file.";
                        }
                    }
                } else {
                    $statusMsg = 'Please select a file to upload.';
                }

                // Display status message
                echo $statusMsg;
            }

// Get images from the database
            $query = $db->query("SELECT * FROM gallery ORDER BY image_id DESC");

            if ($query->num_rows > 0) {

                while ($row = $query->fetch_assoc()) {

                    $imageURL = 'gallery/' . $row["file_name"];
                    echo '<img src="' . $imageURL . '" width="300" height="150" class="gallery_images">';
                    ?>

                    <?php
                }
            } else {
                ?>
                <p>No image(s) found...</p>
            
                
            <?php } ?> 
                </div>
        </div>
        
    </div>
    <a class="back_a" href="index.php">Back</a>
</div>