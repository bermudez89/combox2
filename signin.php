
<?php

    // Get data base connection
    require(__DIR__ . '/config/database.php');

    // Get data from html form
    $e_email = $_POST['email'];
    $p_assword = $_POST['pswd'];
    $pass_enc = md5($p_assword);

    // Search user in Supabase
    $sql = "
        SELECT *
        FROM users
        WHERE email = '$e_email'
        AND password = '$pass_enc'
    ";

    $supa_res = pg_query($supa_conn, $sql);

    // Check login
    if ($supa_res && pg_num_rows($supa_res) > 0) {
        header('Location: index.html');
        exit;
    } else {
        echo "<script>
            alert('Incorrect email or password');
            window.location.href = 'login.html';
        </script>";
        exit;
    }

?>
