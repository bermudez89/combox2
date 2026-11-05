<?php

    //get data base connection 
   require(__DIR__ . '/config/database.php');
   
    //Get data from html form
    $f_name = $_POST['fname'];
    $l_name = $_POST['lname'];
    $m_phone = $_POST['mphone'];
    $e_mail = $_POST['email'];
    $p_assword = $_POST['pswd'];
    $p_assword = md5($p_assword);

    //Sql de validacion si el usuario existe
    $sql_validation = "
        SELECT
            u.email,
            u.mobile_phone
        FROM
            users u
        WHERE
            u.email = '$e_mail'
            OR u.mobile_phone = '$m_phone'
    ";

    $supa_res = pg_query($supa_conn, $sql_validation);

    if (pg_num_rows($supa_res) > 0) {

        $user = pg_fetch_assoc($supa_res);

        if ($user['email'] == $e_mail) {
            echo "<script>alert('User email already exists');</script>";
        } else {
            echo "<script>alert('Phone number already exists');</script>";
        }

        header('refresh:0;url=register.html');

    } else {

        //Preparar query
        $sql = "
            INSERT INTO users (
                firstname, lastname, mobile_phone, email, password
            )
            VALUES (
                '$f_name', '$l_name', '$m_phone', '$e_mail', '$p_assword'
            )
        ";

        $supa_res = pg_query($supa_conn, $sql);

        if ($supa_res) {
            echo "<script>alert('Successful registration');</script>";
            header('refresh:0;url=login.html');
        } else {
            echo "<script>alert('Error registering user');</script>";
            header('refresh:0;url=register.html');
        }
    }
?>
