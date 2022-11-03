<?php
require("connect-db.php");      // include("connect-db.php");
require("login-user-db.php");


$user = null;
?>

<?php
$hash = password_hash("demo", PASSWORD_BCRYPT);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] =='Login') 
  {
      $user = LoginUser($_POST['username'], $_POST['password']);
      if($user != null )
      {
        if($user['login'])
        {
          header('Location: /databases/simpleform.php');
          exit();
        }
      }

  }
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] =='CreateUserPage') 
  {
    header('Location: /databases/createuserform.php');
  }
  
}
//checks if input characters, when turned into text and hashed, match the hashed password
function authenticate()
{
   global $mainpage;
   $hash = '$2y$10$7yMQ/KY5uHu1CwMBdptV5O12zpR9jJA4WcxAZxCT6zXIjyg8G4AWa';
   
   if ($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      $pwd = htmlspecialchars($_POST['password']);      
      if (password_verify($pwd, $hash))
      {  
         header("Location: ".$mainpage);
      }
      else       
         echo "<span class='msg'>Username and password do not match our record.</span> <br/>";
   }	
}
$mainpage = "simpleform.php";   
authenticate();

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
  <h1>Login Page</h1>  

<form name="mainForm" action="loginForm.php" method="post">   
  <div class="row mb-3 mx-3">
    Username:
    <input type="text" class="form-control" name="username" 
    />            
  </div>  
  <div class="row mb-3 mx-3">
    Password:
    <input type="text" class="form-control" name="password" 
    />            
  </div> 

  <!-- <div class="row mb-3 mx-3"> -->
  <div>
    <input type="submit" value="Login" name="btnAction" class="btn btn-dark" 
           title="Login into to UVA course review app" />            
        
  </div> 
    
  <br>
  <div>
    <input type="submit" value="CreateUserPage" name="btnAction" class="btn btn-dark" 
           title="Create user" />            
        
  </div> 

</form>   






</div>    
<br>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>