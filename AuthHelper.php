<?php
// Class for checking and managing authentication
require_once('CSVHelper.php');
require_once('JSONHelper.php');
class AuthHelper {

    // Function for signing a new user up
    public function signUp($email, $password) {
        // check if the email is valid
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Error: Invalid Email or Password';
            return false;
        }
        // check if password length is between 8 and 16 characters
        else if(strlen($password)<8 || strlen($password) > 16) {
            echo 'Invalid: Password must be between 8 and 16 characters';
            return false;
        }
        // check if the file containing users exists
        else if (!file_exists('users.txt')) {
            echo 'Internal Error: Please Try Again Later';
            return false;
        }
        // check if the email is in the database already
        else if ((new CSVHelper('users.txt'))->contains('users.txt', $email, 0)) {
            echo 'Email Already Registered';
            return false;
        }
        else {
            // Encrypt password
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
            $array = array($email, $encrypted_password);
            // Save the user in the database
            $handle = fopen('users.txt', 'a+');
            fputcsv($handle, $array, ';');
            fclose($handle);
            return true;
        }
    }

    // Signing in an existing user 
    public function signIn($email, $password) {

        // 1. check if the email is well formatted
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Email or Password is Invalid';
            return false;
        }
        // 2. check if the password is correct length
        else if (strlen($password)<8 || strlen($password) > 16) {
            echo 'Email or Password is Invalid';
            return false;
        }
        // 3. check if the file containing users exists
        else if (!file_exists('users.txt')) {
            echo 'Error';
            return false;
        }
        // 4. check if the email is registered
        else if (!(new CSVHelper('users.txt'))->contains('users.txt', $email, 0)) {
            echo 'User Not Found';
            return false;
        }
        // 5. check if the password is correct
        else if (!$this->passwordMatch('users.txt', $password)) {
            echo 'Password is Invalid';
            return false;
        }
        else {
            return true;
        }
    }

    // Sign a user out of their account
    public function signOut() {
        // Sign the user out and destroy the current session
	    $_SESSION['logged'] = false;
	    session_destroy();
    }

    // Checks if user is logged in
    public function loggedIn() {
        if($_SESSION['logged']) return true;
        else return false;
    }

    // Returns information about a user
    public function returnInfo($file, $line, $record) {
        if (preg_match('/\.csv/', $file) || preg_match('/\.CSV/', $file) || preg_match('/\.txt/', $file)) {
            $csv_object = new CSVHelper($file);
            $array = $csv_object->readFile();
        }
        else {
            $json_object = new JSONHelper($file);
            $array = $json_object->readFile();
        }
        return $array[$line][$record];
    }

    // Matches Password
    public function passwordMatch($csv_file, $password) {
        $array = (new CSVHelper($csv_file))->readFile();
        for ($i = 0; $i < count($array); $i++) {
            if (password_verify($password, $array[$i][1])) {
                return true;
            }
        }
        return false;
    }

}
?>