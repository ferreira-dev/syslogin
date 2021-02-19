<?php
session_start();
if(isset($_POST['btnLogin']))
{
    include('connection.php');
	$email = $_POST['email'];
	$password    = md5($_POST['password']);
	if(!empty($email) && !empty($password)){
			
		$slt="select * from user where email=:email and password=:password";
		$query=$db->prepare($slt);
		$query->bindParam(':email',$email,PDO::PARAM_STR);
		$query->bindParam(':password',$password,PDO::PARAM_STR);
		$query->execute();
		$row=$query->fetch(PDO::FETCH_ASSOC);
		if(is_array($row))
		{
			$_SESSION["id"] = $row['id'];
			$_SESSION["email"]=$row['email'];
			$_SESSION["first_name"]=$row['first_name'];
			$_SESSION["last_name"]=$row['last_name']; 
			header("Location: dashboard.php"); 
		}
		else
		{
			$msg="usuário ou senha inválidos";
			header ("Location: index.php?error=".$msg);	
			exit;
		}
    }
	else{
		$msg="Preencha os campos";
		header ("Location: index.php?error=".$msg);	
		exit;
	}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title></title>
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
      <a class="navbar-brand" href="index.php">SYSLOGIN</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
	 <?php @$id= $_SESSION["id"];	if ($id): ?>

    <?php header("Location: dashboard.php"); ?>
    <!--
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link"  href="dashboard.php">Dashboard</a>
          </li>
        </ul>
        
          <ul class="navbar-nav my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
       -->
     <?php else: ?>
        <ul class="navbar-nav mr-auto">
          
          <li class="nav-item">
            <a class="nav-link" href="register.php">Registrar</a>
          </li>
        </ul>
      <?php endif; ?> 
      </div>
      </div>
    </nav>

<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3>Login</h3>
        <hr>
         <?php if (isset($_REQUEST['success'])): ?>
          <div class="alert alert-success" role="alert">
            <?php echo $_REQUEST['success']; ?>
          </div>
        <?php endif; ?>
        <form class="" method="post">
          <div class="form-group">
           <label for="email">Email :</label>
           <input type="email" class="form-control" name="email" id="email" value="<?php //set_value('email') ?>">
          </div>
          <div class="form-group">
           <label for="password">Senha :</label>
           <input type="password" class="form-control" name="password" id="password" value="">
          </div>
           <?php if (isset($_REQUEST['error'])): ?>
            <div class="col-12">
              <div class="alert alert-danger" role="alert">
                <?php echo $_REQUEST['error']; ?>
              </div>
            </div>
          <?php endif; ?>
          <div class="row">
            <div class="col-12 col-sm-4">
              <button type="submit" name="btnLogin" class="btn btn-primary">Login</button>
            </div>
            <div class="col-12 col-sm-8 text-right">
              <a href="register.php">Ainda não tem conta? Registre-se</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>