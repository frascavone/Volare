<?php
require_once "../include/init.php";
$page = isset($_GET["page"]) ? $_GET["page"] : 'homepage';
?>


<?php include ROOT_PATH . "public/template-parts/header.php" ?>

<div class="container mt-3">
  <div class="row">
    <?php include "pages/$page.php"; ?>
  </div>
</div>

<?php include ROOT_PATH . "public/template-parts/footer.php" ?>