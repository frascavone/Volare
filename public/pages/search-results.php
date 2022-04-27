<?php
// Impedire di accedere direttamente al file tramite URL
if (! defined('ROOT_URL')) {die;}

if (isset($_POST['add_to_cart'])){

  //prendi i valori di "flight_id", "partenza", "arrivo" e "data_and" dal form
  $flight_id = $_POST['id'];
  $part = $_POST['partenza'];
  $arr = $_POST['arrivo'];
  $data_and = $_POST['data_and'];
  // $data_rit= $_POST['data_rit'];

  //logica di "add_to_cart"
  $cm = new CartManager();
  $cartId =  $cm->getCurrentCartId();

  //aggiungi al carrello "cart_id" il volo "flight_id"
  $cm->addToCart($flight_id, $cartId, $data_and);

  //messaggio per l'utente

}

$data_and = $_POST['data_and'];

//$data_rit= $_POST['data_rit'];

$flightMgr = new FlightFinder();
$flights = $flightMgr->getSome();

?>

<?php if($flights) : ?>
<?php foreach($flights as $flight) : ?>
  
  <div class="card-group mt-3">

    <div class="card text-center">    
      <div class="card-body">
        <small class="text-muted">N. volo</small>
      </div>
      <div class="card-body">
        <h5 class="card-title"><?php echo $flight -> id ?></h5>    
      </div>
    </div>

    <div class="card text-center">    
      <div class="card-body">
        <h5 class="card-title"><?php echo date('g:i', strtotime($flight -> ora_partenza)); ?></h5>        
      </div>
      <div class="card-footer">
        <small class="text-muted"><?php echo $flight -> partenza ?></small>
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
        <h5 class="card-title"><?php echo date('g:i', strtotime($flight -> ora_arrivo)); ?></h5>
      </div>
      <div class="card-footer">
        <small class="text-muted"><?php echo $flight -> arrivo ?></small>
      </div>
    </div>

    <div class="card text-center">    
      <div class="card-body">
        <form action="" method="post">
          <input name="data_and" type="hidden" value="<?php echo $data_and?>">
          <input name="partenza" type="hidden" value="<?php echo $flight -> partenza?>">
          <input name="arrivo" type="hidden" value="<?php echo $flight -> arrivo?>">
          <input name="id" type="hidden" value="<?php echo $flight -> id?>">
          <button name="add_to_cart" type="submit" class="btn btn-primary">SELEZIONA
        </form>
      </div>
      <div class="card-footer">
        <small class=""><?php echo $flight -> prezzo ?> €</small>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
  <?php else : echo "<h4>Ci dispiace, ma non ci sono voli disponibili per gli aeroporti selezionati :(</h4>"?>
<?php endif;?>