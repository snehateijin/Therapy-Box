<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style.css" />
        <script type="text/javascript" src="http://malsup.github.io/min/jquery.form.min.js"></script>
        <script>
            $(document).ready(function ()
            {
                $('form').ajaxForm(function ()
                {
                    alert("Uploaded SuccessFully");
                });
            });

            function preview_image()
            {
                var total_file = document.getElementById("upload_file").files.length;
                for (var i = 0; i < total_file; i++)
                {
                    $('#image_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "' height='280' width='280'>");
                }
            }
        </script>
    </head>
    <body>
        <div id="wrapper" class="box">
            <div class="row">  
                <form action="#" method="post" enctype="multipart/form-data">
                    <label for="upload_file">
                        <img src="images/Plus_button_small.png"/>                        
                    </label>
                    <input type="file" id="upload_file" name="upload_file[]" onchange="preview_image();" multiple="multiple"/>                                        
                    <input type="submit" name='submit_image' value="Upload Image"/>
                </form>
                <div id="image_preview" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    

                </div>
                <a class="back_a" href="index.php">Back</a>
            </div>
        </div>
    </body>
</html>
<?php
if (isset($_POST['submit_image'])) {
$total = count($_FILES['upload_file']['name']); 
echo $total;
    echo "<pre />";
    print_r($_FILES["upload_file"]);
    for ($i = 0; $i < count($_FILES["upload_file"]["name"]); $i++) {
        $uploadfile = $_FILES["upload_file"]["tmp_name"][$i];
        $folder = "gallery/";
        move_uploaded_file($_FILES["upload_file"]["tmp_name"][$i], "$folder" . $_FILES["upload_file"]["name"][$i]);
    }
    exit();
}
?>