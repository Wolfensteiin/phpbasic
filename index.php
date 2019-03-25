<?php

session_start();

// Displaying error msg

if (isset($_SESSION['msg_error'])) {
    
    echo $_SESSION['msg_error'];

    unset($_SESSION['msg_error']);
}  



// Displaying Success msg

if (isset($_SESSION['msg_success'])) {
    
    echo $_SESSION['msg_success'];

    unset($_SESSION['msg_success']);
} 


// checking if error happens then store all the errors in variable array

if (isset($_SESSION['errors'])) {
    
    $errors = $_SESSION['errors'];

    unset($_SESSION['errors']);
} 


?>

<!-- form handling -->

<form action="process.php" method="POST">

    <div>
        <input type="text" name="username" placeholder="Enter Username">    
        <span style="color:red; font-size:14px">
        
        <!-- if set then display error -->
        <?php echo (isset($errors['username_err']) ? $errors['username_err'] : ''); ?>

        </span>
    </div>

    <div>
        <input type="password" name="password" placeholder="Enter Password">
        <span style="color:red; font-size:14px">

            <!-- if set then display error -->
            <?php echo (isset($errors['password_err']) ? $errors['password_err'] : ''); ?>

        </span>
    </div>
        
        <input type="submit" value="Submit" name="submit">

</form>