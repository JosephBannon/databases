<?php
function createPost($title, $content, $professor, $course, $rating)
{
    //include("session.php");

    global $db; 
    $username = $_SESSION["login_ID"];
    $query = "INSERT INTO Post (username, postTitle, postContent, rating) VALUES (:username, :title, :content, :rating)";  

    $result = TRUE;

    try 
    {
        $statement = $db->prepare($query);

        $statement->bindValue(':username', $username);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':rating', $rating);

        $statement->execute();

        
        $statement->closeCursor();
    } 
    catch (PDOException $e)
    {
         var_dump($result);
    }

    $query = "SELECT MAX(postID) FROM Post";  
    $statement = $db->prepare($query);
    $statement->execute();
    $postID = $statement->fetch()[0]; 
    $statement->closeCursor();

    if($professor != "-1")
    {
        $query = "INSERT INTO associated_prof VALUES (:postID, :professor)";  
        try 
        {
            $statement = $db->prepare($query);
            $statement->bindValue(':postID', $postID);
            $statement->bindValue(':professor', $professor);

            $statement->execute();

            $result = $statement->fetch(); 

            $statement->closeCursor();
        } 
        catch (PDOException $e)
        {
            var_dump($result);
        }
    }


    if($course != "-1")
    {
        $query = "INSERT INTO associated_course VALUES (:postID, :course)";  
        try 
        {
            $statement = $db->prepare($query);
            $statement->bindValue(':postID', $postID);
            $statement->bindValue(':course', $course);

            $statement->execute();

            $result = $statement->fetch(); 

            $statement->closeCursor();
        } 
        catch (PDOException $e)
        {
            var_dump($result);
        }
    }



}
?>
