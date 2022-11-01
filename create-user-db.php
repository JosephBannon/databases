<?php
function addUser($username, $password, $firstName, $lastName, $major, $gradYear)
{
    global $db;
    $query = "INSERT INTO User VALUES (:username, :password, :firstName, :lastName, :major, :gradYear)";  
    $result = TRUE;
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':major', $major);
        $statement->bindValue(':gradYear', $gradYear);
        $statement->execute();
        $statement->closeCursor();
    }
    catch (PDOException $e) 
    {
        echo $e->getMessage();
        $result = FALSE;
        // if there is a specific SQL-related error message
        //    echo "generic message (don't reveal SQL-specific message)";

        // if (str_contains($e->getMessage(), "Duplicate"))
		//    echo "Failed to add a friend <br/>";

        //if ($statement->rowCount() == 0)
        //    echo "Failed to add a friend <br/>";
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
    return $result;
}
