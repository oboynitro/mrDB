<?php
require_once 'DB.php';

session_start();
if (isset($_POST['submit']))
{
    $uname = $_POST['username'];
    $pwd = $_POST['password'];

    $data = [
        'username' => $uname,
        'password' => $pwd
    ];

    if (DB::insertRecord('users', $data))
    {
        $_SESSION['response'] = 'Data Entry Successful :)';
    }
    else
    {
        $_SESSION['response'] = 'Data Entry Unsuccessful :(';
    }
}
?>

<html lang="en-us">
<head><title>INSERTION</title></head>
<body>

<?php if (isset($_SESSION['response'])) : ?>
<h4><?php echo $_SESSION['response']?></h4>
<hr>
<?php endif ?>
<form action="." method="POST">
    <label>
        <input name="username" type="text" value="">
    </label>
    <br><br>
    <label>
        <input type="text" value="" name="password">
    </label>
    <br><br>
    <input type="submit" value="SUBMIT" name="submit">
    <br><br>
</form>
</body>
</html>
