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
        //include_once("assets/forms/DepLoginForm.html");
        echo("User already found. Please enter another email.");
    }else
    {

        if($email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if($password1 != "") {
                if ($password1 == $password2) {
                    if($user_type == '')
                    {
                        //include_once("assets/forms/DepLoginForm.html");
                        echo("Error. No user type selected!");
                    }
                    else{
                        $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                        $newest_id = addUser($db, $hashedPassword, $email, $user_type); //If everything is good,add the user
                        if($user_type != "Admin") { //admins don't need profiles
                            addProfile($db, $newest_id);    //Add the new profile to the user's id too
                        }
                        return $newest_id;
                    }
                } else {
                    //include_once("assets/forms/DepLoginForm.html");
                    echo("Error. Passwords do no match");
                }
            }
            else {
                //include_once("assets/forms/DepLoginForm.html");
                echo("<br> Error. Password needed.");
            }
        }
        else
        {
            //include_once("assets/forms/DepLoginForm.html");
            echo("Error. Invalid email entered.");
        }
    }
}

//This is used by the sign up button
//Called by the passwordTest function, if the passwords match
//returns the last id added
function addUser($db, $password, $user, $user_type)
{
    try{
        $stmt = $db->prepare("INSERT INTO users VALUES (null, :email, :password, :user_type, NOW())");
        $stmt->bindParam(':email', $user);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':user_type', $user_type);
        $stmt->execute();
        $lastID = $db->lastInsertID();
        if($user_type != "Admin") {
            //include_once("assets/forms/DepLoginForm.html");
        }
        echo("User added.");
        return $lastID;
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

    $email = $_POST['email'];
    $password = $_POST['password'];

    //echo("email is: " . $email . "<br>");
    //echo("password is : " . $password . "<br>" );

    try {
        $stmt = $db->prepare("SELECT * FROM users");
        $users = array();

        if ($stmt->execute() && $stmt->rowCount() > 0) {

            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user) {

                if ($user['email'] == $email && password_verify($password, $user['password']))
                {
                    $successfulLogin = $user['user_id'];
                }
            }
        } else {
            echo("");
        }
        //echo ("still in signintest, successfulID is " . $successfulLogin);
        echo ($successfulLogin);
        return ($successfulLogin);
    } catch (PDOException $e) {
        die("Grabbing the user list didn't work.");
    }
}

//This grabs the user type with their id
function grabUserType($db, $validID)
{
    $userType = "";

    try {
        $stmt = $db->prepare("SELECT * FROM users");
        $users = array();

        if ($stmt->execute() && $stmt->rowCount() > 0) {

            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user) {

                if ($user['user_id'] == $validID)
                {
                    $userType = $user['type'];
                }
            }
        } else
            echo("No users in list <br>");
        //echo("In grabusertype, user type is is " . $userType);
        return ($userType);
    } catch (PDOException $e) {
        die("Grabbing the user list didn't work.");
    }
}

//This starts a session
function loginSession($ID, $type)
{
    $_SESSION['userID'] = $ID;
    $_SESSION['userType'] = $type;

}