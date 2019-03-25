<?php

session_start();

    // form submission checking

if (isset($_POST['submit'])) {

    // Array to store all errors

    $errors = array();
    
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

    // if username consist of alpha-numeric (a-z, A-Z, 0-9), underscores, and has minimum 5 character and maximum 20 character Ex : user_name12

    $reg_username = '/^[a-z\d_]{5,20}$/i';

    if (!preg_match($reg_username, $username)) {

        $errors['username_err'] = 'Invalid or empty username';
    }

  /* if (empty($username)) {
       
        $errors['username_err'] = 'Enter username';
    } */

    if (empty($password)) {
       
        $errors['password_err'] = 'Enter password';
    }


    // Password Hashing

    $password = password_hash($password, PASSWORD_DEFAULT);

    // Count the errors. If there are zero errors then connect/success otherwise error to users

    // Also Validation of the field

    if (count($errors) == 0) {

        // Database credentials

        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'authentication_system');
        
        // Object of mysqli
        
        $objDB = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Prepare SQL query template for database Step - 1

        $stmt = $objDB->prepare(
                'INSERT INTO authentication_system(username, password) 
                VALUES (?, ?)'
                );

        // bind the parameters to prevent SQL injections
        
        $stmt->bind_param('ss', $username, $password);

        // Execute the statement

        $stmt->execute();



        $_SESSION['msg_success'] = 'Congratulations! Values stored successfully';

        // redirection

        header("location: index.php");

    } else{

        $_SESSION['msg_error'] = 'Oops! Please check the errors :-';

        $_SESSION['errors'] = $errors;

    }

        // redirection

        header("location: index.php");    

}
