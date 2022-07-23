<?php

$username = $_POST['username'];
$password = $_POST['password'];

if (!isset($connection)) {
    $connection = mysqli_connect('localhost', 'root', 'root', 'uas');
}

if ($connection === false) {
    exit;
}

if (empty($_POST['username']) || empty($_POST['password'])) {
    echo 'Silahkan cek kembali username dan password yang anda masukkan';
}

$result = ava_database_query("SELECT uid, username, password FROM users WHERE BINARY username='$username' AND password='$password'");
$count = mysqli_num_rows($result);
$getuser = mysqli_fetch_array($result);

if ($count == 1) {
    session_start();
    $_SESSION['uas_uid'] = $getuser['uid'];
    $_SESSION['uas_username'] = $getuser['username'];
    header('location:index.php?act=user');
}
else {
    echo $loginform;
}

