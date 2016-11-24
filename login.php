<?php

//carga y se conecta a la base de datos
require("config.inc.php");

if (!empty($_POST)) {
    //obteneos los usuarios respecto a la usuario que llega por parametro
    $query = "SELECT email, username, password, admin FROM User WHERE email = :email";
    
    $query_params = array(':email' => $_POST['email']);
    
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch (PDOException $ex) {
        //para testear pueden utilizar lo de abajo
        //die("la consulta murio " . $ex->getMessage());
        
        $response["success"] = 0;
        $response["message"] = "Problema con la base de datos, vuelve a intetarlo";
        die(json_encode($response));
        
    }
    
    //la variable a continuación nos permitirará determinar 
    //si es o no la información correcta
    //la inicializamos en "false"
    $validated_info = false;
    
    //vamos a buscar a todas las filas
    $row = $stmt->fetch();
    if ($row) {

        //encaso que no lo este, solo comparamos como acontinuación
        if ($_POST['password'] === $row['password']) {
            $login_ok = true;
        }
    }
    
    // así como nos logueamos en facebook, twitter etc!
    // Otherwise, we display a login failed message and show the login form again 
    if ($login_ok) {
        $response["success"] = 1;
        $response["message"] = "Inicio de Sesión correcto!";
        die(json_encode($response));
    } else {
        $response["success"] = 0;
        $response["message"] = "Inicio de Sesión incorrecto!";
        die(json_encode($response));
    }
} else {
    ?>
    <h1>Login</h1>
    <form action="login.php" method="post">
        Email:
        <br />
        <input type="text" name="email" placeholder="Email" />
        <br />
        <br /> Password:
        <br />
        <input type="password" name="password" placeholder="password" value="" />
        <br />
        <br />
        <input type="submit" value="Login" />
    </form>
    <?php
}

?>