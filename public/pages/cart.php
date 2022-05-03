<?php

$cm = new CartManager();
$cartId =  $cm->getCurrentCartId();



if(isset($_POST['delete'])){
  
  // cancella elemento del carrello
  $flight_id = $_POST['id'];
  $cm->removeFromCart($flight_id, $cartId);
}

// if (isset($_POST['change'])){
  
//   //modifico dati tratta
  
// }

$cart_total = $cm -> getCartTotal($cartId);
$cart_items = $cm -> getCartItems($cartId);


?>
<div class="col-lg-10 mt-4">

  <?php if(count($cart_items) > 0) : ?>

  <h4 class="d-flex justify-content-between align-items-center mb-3">
    <span>Il tuo viaggio</span>
  </h4>
  <ul class="list-group mb-3">

    <?php foreach($cart_items as $item) :?>

    <li class="list-group-item d-flex justify-content-between lh-sm">
      <div>
        <h6 class="my-0"><?php echo $item['partenza'] ?> - <?php echo $item['arrivo'] ?></h6>
        <p class="my-0 text-muted"><?php echo date('j M', strtotime($item['data'])); ?> &bull; <?php echo date('H:i', strtotime($item['ora_partenza'])); ?> - <?php echo date('H:i', strtotime($item['ora_arrivo'])); ?></p>
        <small class="text-muted">id Volo <?php echo $item['id'] ?></small>
      </div>
      <div class="text-end">
        <h6 ><?php echo $item['prezzo_singolo'] ?> €</h6>
        <form action="" method="post">
          <input type="hidden" name="id" value="<?php echo $item['id'] ?>">

          <!-- FUNZIONALITÀ DA INSERIRE -->
          <!-- <button name="change" type="submit" class="btn btn-sm btn-info">MODIFICA</button> -->

          <button name="delete" type="submit" class="btn btn-sm btn-danger">CANCELLA</button>
        </form>
      </div>
    </li>
    <?php endforeach; ?>       
    <li class="list-group-item d-flex justify-content-between">
      <h5>Totale</h5>
      <h5><?php echo $cart_total['total'] ?> €</h5>
    </li>
  </ul>
  
  <form class="card p-2 d-flex ">
    <div class="row">      
      <a href="<?php echo ROOT_URL; ?>?page=checkout"><button type="submit" class="btn btn-warning col-6">ACQUISTA</button></a>
    </div>
  </form>
  
  <?php else : ?>
    <h4 class="lead">Il tuo carrello è vuoto</h4> 
    <p>Seleziona i tuoi voli per iniziare</p>
    <a href="<?php echo ROOT_URL; ?>public?page=homepage" class="btn btn-primary">TORNA ALLA HOME</a>
  <?php endif;?>  
  
</div>

