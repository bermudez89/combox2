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
    header('refresh:0;url=login.html');
    /*if ($local_res && $supa_res) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registro exitoso | Combox</title>

        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700"
              rel="stylesheet">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
    </head>

    <body class="bg-gradient-primary">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-9">

                    <div class="card shadow-lg border-0 my-5">
                        <div class="card-body text-center p-5">

                            <div class="mb-4">
                                <i class="fas fa-check-circle text-success"
                                   style="font-size: 70px;"></i>
                            </div>

                            <h1 class="h3 text-gray-900 mb-3">
                                ¡Registro exitoso!
                            </h1>

                            <p class="mb-4">
                                Tu cuenta ha sido registrada correctamente.
                                Ya puedes iniciar sesión en Combox.
                            </p>

                            <a href="login.html"
                               class="btn btn-primary btn-user btn-block">
                                Ir al inicio de sesión
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </body>
    </html>
    <?php
    exit;
} else {
    echo "No se pudo completar el registro en ambas bases de datos.";
}
    //mostrar los datos 
    /*
    echo"<br>Fisrt name is: ". $f_name;
    echo"<br>Lastname is: ". $l_name;
    echo"<br>Mobile phone is: ". $m_phone;
    echo"<br>E-mail is: ". $e_email;
    echo"<br>password is: ". $p_assword;
*/
?>