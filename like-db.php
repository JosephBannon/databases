<?php

function userLikePost($username,$postId) {
    global $db;
    //$username = $_SESSION["login_ID"];
    $query1 = "SELECT * FROM `likes` WHERE username=:username AND postID=:postId)";  

    $result1 = 1;

    $doesUserLike = FALSE;

    try 
    {
        $statement1 = $db->prepare($query1);

        $statement1->bindValue(':postId', $postId);
        $statement1->bindValue(':username', $username);


        //$statement1->execute();
        // if ($statement1->rowCount() != 0)
        // {     
        //     $doesUserLike = TRUE;
        //     echo $doesUserLike;
        //     return;
        // }
        // $result1 = $statement1->fetch();

        $statement1->closeCursor();
    } 
    catch (PDOException $e)
    {
         var_dump($e);
    }

    if($doesUserLike == FALSE)
    {   
        $query2 = "INSERT INTO `likes` VALUES (:username, :postID)";  

        $result2 = 2;

        try 
        {
            $statement2 = $db->prepare($query2);

            $statement2->bindValue(':postID', $postId);
            $statement2->bindValue(':username', $username);


            $statement2->execute();
            $result2 = $statement2->fetch();

            $statement2->closeCursor();
        } 
        catch (PDOException $e)
        {
            var_dump($result2);
        }
    }
    return;
}

?>