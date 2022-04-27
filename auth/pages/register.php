<?php

$errMsg = '';

if ($loggedInUser){
  echo '<script>location.href="'.ROOT_URL.'public"</script>';
  exit;
}

if (isset($_POST['register'])){

  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['password']));
  $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));

  $userMgr = new UserManager();
  if($userMgr -> passwordsMatch($password, $confirm_password)){

    $result = $userMgr -> register($email, $password);
    
    if($result){
      echo '<script>location.href="'.ROOT_URL.'auth?page=login"</script>';
      exit;
    } else {
      echo $errMsg = 'Registrazione fallita. Mail già registrata...';
    }
  } else {
    $errMsg = 'Ops...le password non corrispondono.';
  }
}

?>

<h2>Registrazione</h2>
<form method="post" class="mb-4 mt-4">
  <div class="row">
    <div class="form-group col-6">
      <label for="email">Email</label>
      <input name="email" id="email" type="text" class="form-control" value="">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-6">
    <label for="password">Password</label>
    <input name="password" id="password" type="password" class="form-control" value="">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-6">
      <label for="name">Conferma Password</label>
      <input name="confirm_password" id="confirm_password" type="password" class="form-control">
    </div>
  </div>  
  <div class="text-danger mb-2 mt-2">
    <?php echo $errMsg;?>
  </div>
  <div>
    <input class="btn btn-primary mb-2 mt-2 right" type="submit" name="register" value="REGISTRATI">
    <a class="underline" href="<?php echo ROOT_URL; ?>auth?page=login"><p>Hai già un account? Accedi</p></a>
  </div>
</form>