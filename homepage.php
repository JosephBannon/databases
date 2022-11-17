<?php
require("connect-db.php");
require("post-db.php");
include("session.php");

$list_of_posts = getAllPosts();
$list_of_courses = getAllCourses();

?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] =='Filter' && $_POST['formFilter'] >= 0) 
  {
    $list_of_posts = getPostsByCourse($_POST['formFilter']);
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] =='Clear filters') 
  {
    $list_of_posts = getAllPosts();
  }
}
?>

<!DOCTYPE html>
<html>
  
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">      
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
</head>

<text> <?php echo $_SESSION["login_ID"]?> <text>
<body>
<div class="container">
  <div class="row">
    <h1>Posts Feed</h1>  
    <hr/>
    <div class="col-8">
      <?php foreach($list_of_posts as $post): ?>
        <h3><?= $post['postTitle']; ?></h3>
        <h6><?= $post['courseName']==null ? "No affiliated course" : $post['courseName']; ?>, 
          <?= $post['profFirstName']==null ? "No affiliated professor" : $post['profFirstName'];  ?> <?= $post['profLastName']==null ? "" : $post['profLastName']; ?></h6>
        <p><?= $post['postContent']; ?></p>
        <p><em> Posted by <a href=""><?= $post['username']; ?></a> at <?= $post['timePosted']; ?></em></p>
        <p><strong>Rating: <?= $post['rating']; ?>/5</strong></p>
        <hr/>
      <?php endforeach; ?>
    </div>
    <div class="col-4">
      <form name="filterForm" action="homepage.php" method="post">
        <select class="form-select" name="formFilter">
          <option value="-1">Filter by course...</option>
          <?php foreach($list_of_courses as $course): ?>
            <option value="<?= $course['courseID']; ?>"> <?= $course['name']; ?> </option>
          <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" value="Filter" name="btnAction" class="btn btn-secondary" title="Filter by course" />
        <input type="submit" value="Clear filters" name="btnAction" class="btn btn-danger" title="Clear courese filter" />
      </form>
    </div>
  </div>
</div>   

</div>    
<br>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>