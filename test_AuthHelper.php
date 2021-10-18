<?php
    session_start();
    $_SESSION['logged'] = false;
    require_once('AuthHelper.php');
    $auth_helper = new AuthHelper();

    //Sign Up a user and check if logged
    echo '<h4>Sign up a new user and then check if they are logged in</h4><br>';
    $email = 'cameron01@icloud.com';
    $password = 'CoolioMan';
    if ($auth_helper->signUp($email, $password)) {
        $_SESSION['logged'] = true;
    }
    else $_SESSION['logged'] = false;
    echo '$_SESSION[logged] = ';
    print_r($auth_helper->loggedIn());

    // Sign out a user and check if logged
    echo '<br><br>';
    echo '<h4>Sign out the user and check if logged in</h4><br>';
    $auth_helper->signOut();
    echo '$_SESSION[logged] = ';
    print_r($auth_helper->loggedIn());

    echo '<br><br>';
    // Sign in a user and check if logged
    echo '<h4>Sign in a user and check if they are logged in</h4><br>';
    $email = 'cameron01@icloud.com';
    $password = 'CoolioMan';
    if ($auth_helper->signIn($email, $password)) {
        $_SESSION['logged'] = true;
    }
    else {
        $_SESSION['logged'] = false;
    }
    echo '$_SESSION[logged] = ';
    print_r($auth_helper->loggedIn());

    echo '<br><br>';
    // Return the email of the second user in the database
    echo '<h4>Return the email of the second user in the database</h4><br>';
    echo 'Email = '.$auth_helper->returnInfo('users.txt', 1, 0);


?>