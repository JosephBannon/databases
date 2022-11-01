<?php
function addUser($username, $password)
{
    global $db;
    $query = "INSERT INTO User VALUES (:username, :password)";  
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $statement->closeCursor();
    }
    catch (PDOException $e) 
    {
        // echo $e->getMessage();
        // if there is a specific SQL-related error message
        //    echo "generic message (don't reveal SQL-specific message)";

        // if (str_contains($e->getMessage(), "Duplicate"))
		//    echo "Failed to add a friend <br/>";

        if ($statement->rowCount() == 0)
            echo "Failed to add a friend <br/>";
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
}




function LoginUser($username, $password)
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
