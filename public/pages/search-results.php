<?php
// Impedire di accedere direttamente al file tramite URL
if (!defined('ROOT_URL')) {
  die;
}

if (isset($_POST['add_to_cart'])) {

  //prendi i valori di "flight_id", "partenza", "arrivo" e "data" dal form
  $flight_id = $_POST['id'];
  $part = $_POST['partenza'];
  $arr = $_POST['arrivo'];
  $data = $_POST['data'];
  
  //logica di "add_to_cart"
  $cm = new CartManager();
  $cartId =  $cm->getCurrentCartId();

  //aggiungi al carrello "cart_id" il volo "flight_id" con data "$data"
  $cm->addToCart($flight_id, $cartId, $data);

  //messaggio per l'utente

}

$flightMgr = new FlightManager();
$depFlights = $flightMgr->getSome();
?>

<?php if ($depFlights) : ?>

  <h3>Andata</h3>

  <?php foreach ($depFlights as $flight) : ?>

    <div class="card-group mt-3 mb-3" class="departureCard" >
      <div class="card text-center">
        <div class="card-body">
          <small class="text-muted">N. volo</small>
        </div>
        <div class="card-body">
          <h5 class="card-title"><?php echo $flight->id ?></h5>
        </div>
      </div>

      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title"><?php echo date('H:i', strtotime($flight->ora_partenza)); ?></h5>
        </div>
        <div class="card-footer">
          <small class="text-muted"><?php echo $flight->partenza ?></small>
        </div>
      </div>

      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title ">Durata</h5>
          <p class="card-text">orario</p>
        </div>
      </div>

      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title"><?php echo date('H:i', strtotime($flight->ora_arrivo)); ?></h5>
        </div>
        <div class="card-footer">
          <small class="text-muted"><?php echo $flight->arrivo ?></small>
        </div>
      </div>

      <div class="card text-center">
        <div class="card-body">
          <form action="" method="post">
            <input name="id" type="hidden" value="<?php echo $flight->id ?>">
            <input name="partenza" type="hidden" value="<?php echo $flight->partenza ?>">
            <input name="arrivo" type="hidden" value="<?php echo $flight->arrivo ?>">
            <input name="data" type="hidden" value="<?php echo $_GET['data_and']; ?>">
            <button name="add_to_cart" type="submit" class="btn btn-primary">SELEZIONA
          </form>
        </div>
        <div class="card-footer">
          <small class=""><?php echo $flight->prezzo ?> €</small>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <?php if (isset($_GET['data_rit'])) : ?>
  <?php $retFlights = $flightMgr->getSomeInverted(); ?>

    <h3 class="resultCard">Ritorno</h3>

      <?php foreach ($retFlights as $flight) : ?>
      
      <div class="card-group mt-3 mb-3 returnCard" >
      <hr>
        <div class="card text-center">
          <div class="card-body">
            <small class="text-muted">N. volo</small>
          </div>
          <div class="card-body">
            <h5 class="card-title"><?php echo $flight->id ?></h5>
          </div>
        </div>

        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title"><?php echo date('H:i', strtotime($flight->ora_partenza)); ?></h5>
          </div>
          <div class="card-footer">
            <small class="text-muted"><?php echo $flight->partenza ?></small>
          </div>
        </div>

        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title ">Durata</h5>
            <p class="card-text">orario</p>
          </div>
        </div>

        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title"><?php echo date('H:i', strtotime($flight->ora_arrivo)); ?></h5>
          </div>
          <div class="card-footer">
            <small class="text-muted"><?php echo $flight->arrivo ?></small>
          </div>
        </div>

        <div class="card text-center">
          <div class="card-body">
            <form action="" method="post">
              <input name="id" type="hidden" value="<?php echo $flight->id ?>">
              <input name="partenza" type="hidden" value="<?php echo $flight->partenza ?>">
              <input name="arrivo" type="hidden" value="<?php echo $flight->arrivo ?>">
              <input name="data" type="hidden" value="<?php echo $_GET['data_rit']; ?>">
              <button name="add_to_cart" type="submit" class="btn btn-primary">SELEZIONA
            </form>
          </div>
          <div class="card-footer">
            <small class=""><?php echo $flight->prezzo ?> €</small>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
  <?php endif; ?>
<?php else : ?>
  <h5>Ci dispiace, ma non ci sono voli disponibili per gli aeroporti selezionati :(</h5>
  <a href="<?php echo ROOT_URL; ?>public?page=homepage" class="btn btn-primary">TORNA ALLA HOME</a>
<?php endif; ?>