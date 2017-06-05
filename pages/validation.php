<?php

		    if ($_SERVER['REQUEST_METHOD']) {
        $errors = array();
        
        //validating email 
       $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format"; 
}
    
        //checking if passwords match 
        if($_POST['password'] != $_POST['password2']){
            $errors[] = "Passwords don't match";
        }
        
    
    
    $password = $_POST['password'];
    echo $password;
     if (strlen($password) < '6') {
        $errors[] = "Your Password Must Contain At Least 6 Characters!";
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        $errors[] = "Your Password Must Contain At Least 1 Number!";
        echo "Doesnt have at least one nmber";
    }
    elseif(!preg_match("#[A-Z]+#",$password) || !preg_match("#[a-z]+#",$password)){
        $errors[] = "Your Password Must Contain At Least 1 letter!";
    }
    
    elseif(!preg_match("/[\'^£$%&*()}{@#~?<>,|=_+!-]/", $password)){
        $error[] = "Your Password Must Contain At Least One Symbol!";
    }
            }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <title></title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
        
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="">
    </head>
    
    <body>
        <div class="container">
            <div class="row">
                <?php
                    if (sizeof($errors) > 0) {
                        echo '<h3>Error!</h3><p>Please fix the following errors:</p>';
                        
                        echo '<ul>';
                        foreach ($errors as $error) {
                            echo "<li>$error</li>";
                        }
                        echo '</ul>';
                    } else {
                        echo '<h3>Success!</h3><p>Thanks for entering a new payroll record!</p>';
                    }
                ?>
            </div>
        </div>
    </body>
</html>