<?php
$page = isset($_GET["page"]) ? $_GET["page"] : 'dashboard';
?>

<?php include "../include/init.php"?>

<?php include ROOT_PATH . "public/template-parts/header.php"?>

<div id="main" class="container mt-3">
  <div class="row">
    <div class="col-9">
      <?php include ROOT_PATH . "user/pages/" . $page . ".php" ?>
    </div>
    <div class="col-3">
      <?php include ROOT_PATH . "public/template-parts/sidebar.php" ?> 
    </div>
  </div>
</div>

<?php include ROOT_PATH . "public/template-parts/footer.php"?>
