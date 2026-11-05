
<?php

    // Get data base connection
    require(__DIR__ . '/config/database.php');

    session_start();

    if(isset($_SESSION['userId'])){
        header('refresh:0;url=home.php');
    }
    //Get data from html form
    $e_mail = $_POST['email'];
    $p_assword = $_POST['pswd'];
    $pass_enc = md5($p_assword);
$sql = "SELECT u.*, u.firstname || ' ' || u.lastname as fullname FROM users u WHERE email = '$e_mail' AND password = '$pass_enc'";
    $res = pg_query($supa_conn, $sql);
    if (pg_num_rows($res) > 0) {
        $row = pg_fetch_assoc($res);

        $_SESSION['userId'] = $row['id'];
         $_SESSION['fullName'] = $row['fullname'];
        $_SESSION['fName'] = $row['firstname'];
        $_SESSION['lName'] = $row['lastname'];

        echo "<script>alert('Login successful :::');</script>";
        header('refresh:0;url=index.php');
        } else {
            echo "<script>alert('Invalid email or password :::');</script>";
            header('refresh:0;url=login.html');
        }

       