<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/22/2018
 * Time: 5:31 PM
 */


//This is for the sign up button
//Checking if the user exists in the user database
//If it does, return true, otherwise, return false
function discoverUser($db)
{
    $email = $_POST['newUserEmail'];
    $found = false;
    try{
        $stmt = $db->prepare("SELECT email FROM users");
        $users = array();

        if($stmt->execute() && $stmt->rowCount() > 0)
        {
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($users as $user)
            {
                if($user['email'] == $email)
                {
                    $found = true;
                }
            }
        }
        else
            echo("No users in list <br>");
        return($found);
    }catch(PDOException $e)
    {
        die("Grabbing the user list didn't work.");
    }
}

//This is also for the sign up button
//This is called to test if the 2 sign up passwords match, and the email is proper
//if they don't it returns an error and doesn't add the user to the table
function signupTest($db, $found)
{
    //Post are called from the LoginForm
    $email = $_POST['newUserEmail'];
    $password1 = $_POST['newUserPassword'];
    $password2 = $_POST['newUserPassword2'];
    $user_type = $_POST['userType'];

    if($found == true) {
        include_once("assets/forms/LoginForm.php");
        echo("User already found. Please enter another email.");
    }else
    {

        if($email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if($password1 != "") {
                if ($password1 == $password2) {
                    if($user_type == '')
                    {
                        include_once("assets/forms/LoginForm.php");
                        echo("Error. No user type selected!");
                    }
                    else{
                        $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                        //If everything is good, finally add!
                        add_user($db, $hashedPassword, $email, $user_type);
                    }
                } else {
                    include_once("assets/forms/LoginForm.php");
                    echo("Error. Passwords do no match");
                }
            }
            else {
                include_once("assets/forms/LoginForm.php");
                echo("<br> Password needed.");
            }
        }
        else
        {
            include_once("assets/forms/LoginForm.php");
            echo("Error. Invalid email entered.");
        }
    }
}

//This is used by the sign up button
//Called by the passwordTest function, if the passwords match
function add_user($db, $password, $user, $user_type)
{
    try{
        $stmt = $db->prepare("INSERT INTO users VALUES (null, :email, :password, :user_type, NOW())");
        $stmt->bindParam(':email', $user);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':user_type', $user_type);
        $stmt->execute();
        include_once("assets/forms/LoginForm.php");
        echo("User added.");
    }catch(PDOException $e)
    {
        die("<br>Adding a user did not work");
    }
}

//This code is called by the login button
//If tests if the user-given values match with the user table
function signinTest($db)
{
    $successfulLogin = "";
    $email = $_POST['signInEmail'];
    $password = $_POST['signInPassword'];
    //var_dump($_POST['signInEmail']);
    //var_dump($_POST['signInPassword']);

    try {
        $stmt = $db->prepare("SELECT * FROM users");
        $users = array();

        if ($stmt->execute() && $stmt->rowCount() > 0) {

            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($users);
            foreach ($users as $user) {
                if ($user['email'] == $email && password_verify($password, $user['password']))
                {
                    $successfulLogin = $user['user_id'];
                }
                var_dump($user['email']);
                var_dump($email);
                var_dump(password_verify($password, $user['password']));
                var_dump($password);
            }
        } else
            echo("No users in list <br>");
        return ($successfulLogin);
    } catch (PDOException $e) {
        die("Grabbing the user list didn't work.");
    }
}