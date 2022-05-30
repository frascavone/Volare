<?php
// Impedire di accedere direttamente al file tramite URL
if (!defined('ROOT_URL')) {
  die;
}

if (isset($_POST['add_to_cart'])) {

  //prendi i valori di "flight_id", "partenza", "arrivo" e "data" dal form
  $flightId = $_POST['id'];
  $dep = $_POST['departure'];
  $dest = $_POST['destination'];
  $flightDate = $_POST['flightDate'];
  $psg = $_POST['passengers'];

  //logica di "add_to_cart"
  $cm = new CartManager();
  $cartId =  $cm->getCurrentCartId();

  //aggiungi al carrello "cart_id" il volo "flight_id" con data "$data"
  $cm->addToCart($flightId, $cartId, $flightDate, $psg);

  //messaggio per l'utente

}

$flightMgr = new FlightManager();
$depFlights = $flightMgr->getSome();
?>

<?php if ($depFlights) : ?>

  <h3>Andata</h3>

  <?php foreach ($depFlights as $flight) :
    $depTime = new DateTime($flight->depTime);
    $destTime = new DateTime($flight->destTime);
  ?>

    <div class="container">
      <div class="card-group" id="departureCard">
        <div class="card">
          <div class="card-body">
            <small class="text-muted">N. volo</small>
          </div>
          <div class="card-body">
            <h6 class="card-title"><?php echo $flight->id ?></h6>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h6 class="card-title"><?php echo date('H:i', strtotime($flight->depTime)); ?></h6>
          </div>
          <div class="card-footer">
            <small class="text-muted"><?php echo $flight->departure ?></small>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h6 class="card-title "><i class="fa-solid fa-plane-departure"></i></h6>
            <p class="card-text"><?php echo ($depTime->diff($destTime))->format('%h h e %i min') ?></p>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h6 class="card-title"><?php echo date('H:i', strtotime($flight->destTime)); ?></h6>
          </div>
          <div class="card-footer">
            <small class="text-muted"><?php echo $flight->destination ?></small>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <form action="" method="post">
              <input name="id" type="hidden" value="<?php echo $flight->id ?>">
              <input name="departure" type="hidden" value="<?php echo $flight->departure ?>">
              <input name="destination" type="hidden" value="<?php echo $flight->destination ?>">
              <input name="flightDate" type="hidden" value="<?php echo $_GET['dateOut']; ?>">
              <input name="passengers" type="hidden" value="<?php echo $_GET['passengers']; ?>">
              <button type="submit" name="add_to_cart" class="btn btn-primary p-1">SELEZIONA</button>
            </form>
          </div>
          <div class="card-footer">
            <small class=""><?php echo $flight->price ?> €</small>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <?php if (isset($_GET['dateIn'])) : ?>
    <h3>Ritorno</h3>

    <?php $retFlights = $flightMgr->getSomeInverted(); ?>

    <?php foreach ($retFlights as $flight) : ?>

      <div class="container">
        <div class="card-group" id="returnCard">
          <hr>
          <div class="card">
            <div class="card-body">
              <small class="text-muted">N. volo</small>
            </div>
            <div class="card-body">
              <h6 class="card-title"><?php echo $flight->id ?></h6>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h6 class="card-title"><?php echo date('H:i', strtotime($flight->depTime)); ?></h6>
            </div>
            <div class="card-footer">
              <small class="text-muted"><?php echo $flight->departure ?></small>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h6 class="card-title "><i class="fa-solid fa-plane-departure fa-flip-horizontal"></i></h6>
              <p class="card-text"><?php echo ($depTime->diff($destTime))->format('%h h e %i min') ?></p>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h6 class="card-title"><?php echo date('H:i', strtotime($flight->destTime)); ?></h6>
            </div>
            <div class="card-footer">
              <small class="text-muted"><?php echo $flight->destination ?></small>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <form action="" method="post">
                <input name="id" type="hidden" value="<?php echo $flight->id ?>">
                <input name="departure" type="hidden" value="<?php echo $flight->departure ?>">
                <input name="destination" type="hidden" value="<?php echo $flight->destination ?>">
                <input name="flightDate" type="hidden" value="<?php echo $_GET['dateIn']; ?>">
                <input name="passengers" type="hidden" value="<?php echo $_GET['passengers']; ?>">
                <button type="submit" name="add_to_cart" class="btn btn-primary p-1">SELEZIONA</button>
              </form>
            </div>
            <div class="card-footer">
              <small class=""><?php echo $flight->price ?> €</small>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
<?php else : ?>
  <h5>Ci dispiace, ma non ci sono voli disponibili per gli aeroporti selezionati :(</h5>
  <a href="<?php echo ROOT_URL; ?>public?page=homepage" class="btn btn-primary">TORNA ALLA HOME</a>
<?php endif; ?>