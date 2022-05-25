<?php

$cm = new CartManager();
$cartId =  $cm->getCurrentCartId();

if (isset($_POST['delete'])) {

  // cancella elemento del carrello
  $flightId = $_POST['id'];
  $cm->removeFromCart($flightId, $cartId);
}

// if (isset($_POST['change'])){
//   //modifico dati tratta
// }

$cartTotal = $cm->getCartTotal($cartId);
$tickets = $cm->getTickets($cartId);

?>


<?php if (count($tickets) > 0) : ?>

  <h4 class="d-flex justify-content-between align-items-center mb-3">
    <span>Il tuo viaggio</span>
  </h4>
  <ul class="list-group mb-3">

    <?php foreach ($tickets as $ticket) : ?>

      <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
          <h6 class="my-0"><?php echo $ticket['departure'] ?> - <?php echo $ticket['destination'] ?></h6>
          <p class="my-0 text-muted"><?php echo date('j M', strtotime($ticket['flightDate'])); ?> &bull; <?php echo date('H:i', strtotime($ticket['depTime'])); ?> - <?php echo date('H:i', strtotime($ticket['destTime'])); ?></p>
          <small class="text-muted">id Volo <?php echo $ticket['id'] ?></small>
        </div>
        <div class="text-end">
          <h6>
            <?php
            if ($ticket['passengers'] > 1) {
              echo $ticket['passengers'] . ' x ';
            }
            echo $ticket['singlePrice'];
            ?> €
          </h6>
          <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $ticket['id'] ?>">
            <!-- FUNZIONALITÀ DA INSERIRE -->
            <!-- <button name="change" type="submit" class="btn btn-sm btn-info">MODIFICA</button> -->
            <button name="delete" type="submit" class="btn btn-sm btn-danger">CANCELLA</button>
          </form>
        </div>
      </li>
    <?php endforeach; ?>
    <li class="list-group-item d-flex justify-content-between">
      <h5>Totale</h5>
      <h5><?php echo $cartTotal['total'] ?> €</h5>
    </li>
  </ul>

  <form class="card row text-center p-2">
    <div>
      <a href="<?php echo ROOT_URL; ?>public?page=checkout" role="button" type="submit" class="btn btn-warning col-6">ACQUISTA</a>
    </div>
  </form>

<?php else : ?>
  <h4 class="lead">Il tuo carrello è vuoto</h4>
  <p>Seleziona i tuoi voli per iniziare</p>
  <a href="<?php echo ROOT_URL; ?>public?page=homepage" class="btn btn-primary">TORNA ALLA HOME</a>
<?php endif; ?>