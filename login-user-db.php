<?php
function LoginUser($username, $password)
{
    global $db; 
    $pwd = htmlspecialchars($password); #converts input to plaintext
    $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT);
    $query = "SELECT * FROM User WHERE username=:username AND password=:password";
    try 
    {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $hashedpwd);

        $statement->execute();
        if ($statement->rowCount() == 0)
        {
            $result = array(
                "login" => FALSE
            );
        }
        else
        {
            $result = $statement->fetch(); 
            $result = array_merge($result, array("login" => TRUE));
            $_SESSION['login_ID']=$result['username'];
        }
        $statement->closeCursor();
    } 
    catch (PDOException $e)
    {
         var_dump($result);
    }
    return $result;
}
?>
