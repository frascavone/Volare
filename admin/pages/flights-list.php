<?php

// Impedire di accedere direttamente al file tramite URL
if (! defined('ROOT_URL')) {die;} 

$flightMgr = new FlightShower();
$flights = $flightMgr->getAll();
?>

<h2>Elenco Voli disponibili</h2>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Partenza</th>
      <th scope="col">Ora Partenza</th>
      <th scope="col">Ora Arrivo</th>
      <th scope="col">Arrivo</th>
      <th scope="col">Prezzo</th>
      <th scope="col">Prezzo Business</th>
    </tr>
  </thead>
  <tbody>
    <?php if($flights) : ?>
    <?php foreach($flights as $flight) : ?>
    <tr>
      <th scope="row"><?php echo $flight -> id ?></th>
      <td><?php echo $flight -> partenza ?></td>
      <td><?php echo $flight -> ora_partenza ?></td>
      <td><?php echo $flight -> ora_arrivo ?></td>
      <td><?php echo $flight -> arrivo ?></td>
      <td><?php echo $flight -> prezzo ?> €</td>
      <td><?php echo $flight -> prezzo_business ?> €</td>
      <td><a href="<?php echo ROOT_URL . 'admin?page=flight-details&id=' . $flight -> id?>"><button type="button" class="btn btn-primary">DETTAGLI</button></a></td>
    </tr>
    <?php endforeach; ?>
    <?php endif;?>
  </tbody>
</table>