<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css" />
<?php
include_once 'class.user.php';
$user = new User(); // Checking for user logged in or not

if (isset($_REQUEST['submit'])) {
    extract($_REQUEST);
    $profpic = $_FILES["image_field"]["name"];
    //echo $profpic;
    if ($upass == $ucpass) {

        $register = $user->reg_user($uname, $uemail, $upass, $profpic);
        if ($register) {
            echo 'Registration successful <a href="login.php">Click here</a> to login';
            $uploaddir = 'uploads/';
            $uploadfile = $uploaddir . basename($_FILES['image_field']['name']);
            if (move_uploaded_file($_FILES['image_field']['tmp_name'], $uploadfile)) {
                echo "Image succesfully uploaded.";
            } else {
                echo "Image uploading failed.";
            }
        } else {
            echo "Email or Username Already Exist";
        }
    } else {
        echo "Password Not Match";
    }
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<style><!--
    #container{width:400px; margin: 0 auto;}
    --></style>

<script type="text/javascript" language="javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#prof-image').attr('src', e.target.result);
                $('.text-block').hide();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    function submitreg() {
        var form = document.reg;
        if (form.uname.value == "") {
            alert("Enter username.");
            return false;
        } else if (form.upass.value == "") {
            alert("Enter password.");
            return false;
        } else if (form.ucpass.value == "") {
            alert("Enter confirm password.");
            return false;
        } else if (form.uemail.value == "") {
            alert("Enter email.");
            return false;
        }
    }
</script>
<div id="container" class="registration_div">
    <h1>Hackathon</h1>
    <form action="" method="post" name="reg" enctype="multipart/form-data" class="registration_form">
        <table>
            <tbody>  
                <tr>
            <td><input type="text" name="uname" required="" placeholder="User Name"/></td>
            <td><input type="text" name="uemail" required="" placeholder="Email"/></td>
            </tr>            
            <tr>
                
                <td><input type="password" name="upass" required="" placeholder="Password"/></td>
                <td><input type="password" name="ucpass" required="" placeholder="Confirm Password"/></td>
            </tr>
            </tbody>
        </table>
            
                <span class="image-upload">
                    <label for="file-input">
                        
                        <img src="images/Add_picture.png" id="prof-image"/>
                        
                    </label>
                    <input id ="file-input" type="file" name="image_field" onchange="readURL(this);"/> </span>

            
                    <span><input onclick="return(submitreg());" type="submit" name="submit" value="Register" /></span>
            
                    <span><a href="login.php">Already registered! Click Here!</a></span>
            
            
    </form></div>

