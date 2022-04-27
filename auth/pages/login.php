<?php

$errMsg = '';

if ($loggedInUser){
  echo '<script>location.href="'.ROOT_URL.'public"</script>';
  exit;
}

if (isset($_POST['login'])){

  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['password'])); 
  $userMgr = new UserManager();
  $result = $userMgr -> login($email, $password);

  if($result){
    echo '<script>location.href="'.ROOT_URL.'public"</script>';
  exit;
  } else {
    echo $errMsg = 'Login fallito...';
  }

} 

?>


<h2>Login</h2>
<form method="post" class="mb-4 mt-4">
  <div class="row">
    <div class="form-group col-6">
      <label for="email">Email</label>
      <input name="email" id="email" type="text" class="form-control col-4" value="">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-6">
      <label for="password">Password</label>
      <input name="password" id="password" type="password" class="form-control" value="">
    </div>
  </div>
  <div>
    <input class="btn btn-primary mb-2 mt-2 right" type="submit" value="ACCEDI" name="login">
    <a class="underline" href="<?php echo ROOT_URL; ?>auth?page=register"><p>Non hai un account? Registrati</p></a>
  </div>  
</form>