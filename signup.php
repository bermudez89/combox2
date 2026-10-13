<?php

    //get data base connection 
   require(__DIR__ . '/config/database.php');
    //get data from html form obtener datos del cliente 

    $f_name =   $_POST['fname'];
    $l_name =   $_POST['lname'];
    $m_phone =  $_POST['mphone'];
    $e_email =  $_POST['email'];
    $p_assword = $_POST['pswd'];
    $pass_enc = md5($p_assword);

    // Insert into database hacer el insertar en la base de datos 
    $sql = "
        INSERT INTO users (
            firstname,
            lastname,
            mobile_phone,
            email,
            password
        )
        VALUES (
            '$f_name',
            '$l_name',
            '$m_phone',
            '$e_email',
            '$pass_enc'
        )
    ";
    $local_res= pg_query($local_conn,$sql);
    $supa_res= pg_query($supa_conn,$sql);

    if ($local_res){
        echo "<br>User has bean created succesfully into local database!!";
    }
    else
        echo"<br>User hasn't been created into local database!!";

    if ($supa_res){
        echo "<br>User has bean created succesfully into supa database!!";
    }
    else
        echo"<br>User hasn't been created into supa database!!";

    echo "<script>alert('User has been created succesfully :::')</script>";
    header('refresh:0;url=signin.html');
    //mostrar los datos 
    /*
    echo"<br>Fisrt name is: ". $f_name;
    echo"<br>Lastname is: ". $l_name;
    echo"<br>Mobile phone is: ". $m_phone;
    echo"<br>E-mail is: ". $e_email;
    echo"<br>password is: ". $p_assword;
*/
?>