<?php
require("connect-db.php"); 
require("create-post-db.php");
require("post-db.php");
include("session.php");


$list_of_profs = getAllProfs();
$list_of_courses = getAllCourses();

?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] =='CreatePost') 
  {
    createPost($_POST['title'], $_POST['content'], $_POST['prof'], $_POST['course'], $_POST['rating']);
    header("Location: /databases/homepage.php");
    exit();
  }

  
}
//checks if input characters, when turned into text and hashed, match the hashed password


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">      
  <title>DB interfacing</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />

</head>

<body>


<div class="container">
  <h1>Create Post</h1>  

<form name="createPostForm" action="createPostForm.php" method="post">   
  <div class="row mb-3 mx-3">
    <div class="col-8">

      Title:
      <input type="text" class="form-control" name="title" 
      />            
      Content: <br>
      <textarea name="content" rows="6" cols="89" wrap="soft"> </textarea>
    </div> 
    <div class="col-4">
      Professor:
        <select class="form-select" name="prof">
          <option value="-1">No Professor Selected...</option>
          <?php foreach($list_of_profs as $prof): ?>
            <option value="<?= $prof['profID']; ?>"> <?= $prof['firstName']; ?> <?= $prof['lastName']; ?> </option>
          <?php endforeach; ?>
        </select>
        <br>
      Courses:
        <select class="form-select" name="course">
          <option value="-1">No Course Selected...</option>
          <?php foreach($list_of_courses as $course): ?>
            <option value="<?= $course['courseID']; ?>"> <?= $course['name']; ?> </option>
          <?php endforeach; ?>
        </select>
        <br>
      Rating:
        <select class="form-select" name="rating" aria-label="One">
          <option value=1>One</option>
          <option value=2>Two</option>
          <option value=3>Three</option>
          <option value=4>Four</option>
          <option value=5>Five</option>
        </select>
        <br>
    </div>

  </div>
  <div class="row mb-3 mx-3">
    <input type="submit" value="CreatePost" name="btnAction" class="btn btn-primary" 
          title="Create Post" />     
  </div>


</form>   

</div>    
<br>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>