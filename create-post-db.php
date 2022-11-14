<?php
function createPost($username, $password)
{
    global $db; 
    $query = "SELECT * FROM User WHERE username=:username AND password=:password";
    try 
    {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);

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
