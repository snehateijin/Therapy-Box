<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css" />
<?php
session_start();
include_once 'class.user.php';
$user = new User();

if (isset($_REQUEST['submit'])) {
    extract($_REQUEST);
    $login = $user->check_login($username, $password);
    if ($login) {
        // Login Success
        header("location:index.php");
    } else {
        // Login Failed
        echo 'Wrong username or password';
    }
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style><!--
    #container{width:400px; margin: 0 auto;}

    --></style>

<script type="text/javascript" language="javascript">

    function submitlogin() {
        var form = document.login;
        if (form.username.value == "") {
            alert("Enter email or username.");
            return false;
        } else if (form.password.value == "") {
            alert("Enter password.");
            return false;
        }
    }

</script>

<div id="container" class="Login_div">
    <h1>Hackathon</h1>
    <form action="" method="post" name="login" class="login_form">
        <table>
            <tbody>
                <tr>
                    <td><input type="text" name="username" required=""  placeholder="UserName"/></td>
                    <td><input type="password" name="password" required="" placeholder="Password"/></td>
                </tr>
            </tbody>
        </table>

        <span class="login_button"><input onclick="return(submitlogin());" type="submit" name="submit" value="Login"/></span>



    </form>
    <span class="login_form_bottom_text">New to the hackathon ?<a href="registration.php">Sign Up</a></span>
</div>
