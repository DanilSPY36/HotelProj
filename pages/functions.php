<?php
function connect(
    $host = "localhost",
    $user = "root",
    $pass = "",
    $dbname = "hotels")
{
    $link = new mysqli($host, $user, $pass, $dbname);
    if($link -> connect_error) 
    {
        die("Error: " .$link->connect_error); // exit();
    }
    else
    {
        return $link;
    }
}

function register($login, $email, $pass)
{
    $login= trim(htmlspecialchars($login));
    $email= trim(htmlspecialchars($email));
    $pass= trim(htmlspecialchars($pass));

    if($login == "" || $email == "" || $pass == ""){
        echo "<h3 class='text-danger text-center'> Какое-то поле не заполнено!</h3>";
        return false;
    }
    if(strlen($login) < 3 || strlen($login) > 30)
    {
        echo "<h3 class='text-danger text-center'> Длинна логина должна быть от 3 до 30 символов </h3>";
        return false;
    }
    if(strlen($pass) < 8 || strlen($pass) > 30)
    {
        echo "<h3 class='text-danger text-center'> Длинна пароля должна быть от 8 до 30 символов </h3>";
        return false;
    }
    $ins = "insert into users(login, email, pass, roleid) values('$login','$email','".md5($pass)."', 2)";
    $link = connect();
    $link->query($ins);
    $link->close();
    return true;
}
?>