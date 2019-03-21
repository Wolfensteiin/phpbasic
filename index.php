
<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "Registration";

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

?>


<?php

if (isset($_POST['submit'])) {
    
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $passport = $_POST['passport'];
    $contact  = $_POST['contact'];
    $age      = $_POST['age'];
    $dob      = $_POST['dob'];
    $pass     = md5($_POST['pass']);
    ;
    $imagename = $_FILES['upload']['name'];
    $tmpname   = $_FILES['upload']['tmp_name'];
    $folder    = "images/" . $imagename;
    move_uploaded_file($tmpname, $folder);
    
    //  echo "<img src='$folder' height='100' width='100'>"
    
    //   $query = "INSERT INTO table_name (col1, col2, col3, col4, col5)
    //         VALUES ('{$field1}','{$field2}','{$field3}','{$field4}','{$field5}')";
    
    $query = $mysqli = new mysqli("INSERT INTO user_register VALUES ('$name', $email, '$passport', $contact, '$age', '$dob', '$pass', '$folder')");
    
    $data = $mysqli->query($query);
    //$mysqli->close();
    
    if ($data) {
        echo "Data inserted";
    }
    
}
?>

<html>
        <header>
            <h1>Register</h1>
            <div class="success"></div>
        </header>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="passport" placeholder="Passport" required>
                <input type="text" name="contact" placeholder="Contact" required>
                <input type="text" name="age" placeholder="Age" required>
                <input type="date" size="60" name="dob" placeholder="DOB"/>
                <input type="password" name="pass" placeholder="Password" required>
                <input type="file" name="upload" multiple="multiple"> 
                <input type="submit" name="submit" value="Submit">
        </form> 
    </body>
</html>


<?php
$query = "SELECT * FROM user_register";

if ($result = $mysqli->query($query)) {
    
    while ($row = $result->fetch_assoc()) {
        
        $name     = $row["name"];
        $email    = $row["email"];
        $passport = $row["passport"];
        $contact  = $row["contact"];
        $age      = $row["age"];
        $dob      = $row["dob"];
        $pass     = $row["pass"];
        $profpic  = $row["profpic"];
        
        echo '<tr> 
                <td>' . $name . '</td> 
                <td>' . $email . '</td> 
                <td>' . $passport . '</td> 
                <td>' . $contact . '</td> 
                <td>' . $age . '</td>
                <td>' . $dob . '</td> 
                <td>' . $pass . '</td>
                <td>' . $profpic . '</td>
            </tr>';
    }
    $result->free();
    
}
?>
