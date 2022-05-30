<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://bootswatch.com/5/zephyr/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    <?php include "../assets/css/style.css" ?>
  </style>
  <title>Volare</title>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-primary" aria-label="Fourth navbar example">
    <div class="container">
      <a class="navbar-brand m-0" href="<?php echo ROOT_URL; ?>public?page=homepage">
        <img id="logo" src="<?php echo ROOT_URL ?>assets/immagini/airlogo.png" alt="logo">
        <p style="margin:0;">VOLARE</p>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav ms-auto align-items-center">
          <!-- <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?php echo ROOT_URL; ?>public?page=test">test</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="<?php echo ROOT_URL; ?>public?page=homepage">Home</a>
          </li>

          <?php if (!$loggedInUser) : ?>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?php echo ROOT_URL; ?>auth?page=login">Accedi</a>
            </li>
            <li>
              <a class="nav-link" aria-current="page" href="<?php echo ROOT_URL; ?>auth?page=register">Registrati</a>
            </li>
          <?php endif; ?>

          <?php if ($loggedInUser) : ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $loggedInUser->email ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdown04">
                <li><a class="dropdown-item" href="<?php echo ROOT_URL; ?>auth?page=logout">Logout</a></li>
              </ul>
            </li>
          <?php endif; ?>

          <li class="nav-item">
            <a style="text-decoration: none" href="<?php echo ROOT_URL . 'public/?page=cart'; ?>">
              <span class="badge rounded-pill bg-warning text-dark js-totCartItems"></span>
              <i class="fa-solid fa-cart-shopping" style="color: white;"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>