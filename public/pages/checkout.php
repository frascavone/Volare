<h1>Checkout</h1>

<?php
$cm = new CartManager();
$cartId =  $cm->getCurrentCartId();
if (isset($_POST['delete'])) {
  // cancella elemento del carrello
  $flight_id = $_POST['id'];
  $cm->removeFromCart($flight_id, $cartId);
}
$cart_total = $cm->getCartTotal($cartId);
$cart_items = $cm->getCartItems($cartId);
?>

<!-- <div class="row g-5"> -->


<ul class="list-group mb-3">

  <?php foreach ($cart_items as $item) : ?>
    <li class="list-group-item d-flex justify-content-between lh-sm">
      <div>
        <h6 class="my-0"><?php echo $item['partenza'] ?> - <?php echo $item['arrivo'] ?></h6>
        <p class="my-0 text-muted"><?php echo date('j M', strtotime($item['data'])); ?> &bull; <?php echo date('H:i', strtotime($item['ora_partenza'])); ?> - <?php echo date('H:i', strtotime($item['ora_arrivo'])); ?></p>
        <small class="text-muted">id Volo <?php echo $item['id'] ?></small>
      </div>
      <div class="text-end">
        <h6><?php echo $item['prezzo_singolo'] ?> €</h6>
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

<div class="row">
  <h3>Dati passeggero</h3>
  <form class="needs-validation" novalidate>
    <div class="row g-3">
      <div class="col-sm-6">
        <label for="firstName" class="form-label">Nome</label>
        <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
        <div class="invalid-feedback">
          È necessario fornire un nome valido.
        </div>
      </div>

      <div class="col-sm-6">
        <label for="lastName" class="form-label">Cognome</label>
        <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
        <div class="invalid-feedback">
          È necessario fornire un cognome valido.
        </div>
      </div>

      <div class="col-12">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email">
        <div class="invalid-feedback">
          Inserisci un indirizzo email valido per l'invio dei biglietti.
        </div>
      </div>

      <hr class="my-4">

      <div style="text-align: center;">
        <div id="paypal-button-container"> </div>
      </div>
      <script src="https://www.paypal.com/sdk/js?client-id=AeQuPmgMhxvFbeHJLYFsI7L8UCiIhTldxPjreVms0SmAosY5StG5TOu6KreY_DU5Wq9YeF7o1YHiZNej&currency=EUR&disable-funding=sofort,mybank" data-namespace="paypal_sdk">
      </script>
      <script>
        paypal_sdk.Buttons({
          // Sets up the transaction when a payment button is clicked
          style: {
            shape: 'pill'
          },
          createOrder: (data, actions) => {
            return actions.order.create({
              purchase_units: [{
                amount: {
                  value: <?php echo $cart_total['total'] ?> // Can also reference a variable or function
                }
              }]
            });
          },
          // Finalize the transaction after payer approval
          onApprove: (data, actions) => {
            window.location.replace("http://localhost/Volare/public?page=success");
            // removeCart($cartId);
            return actions.order.capture().then(function(orderData) {
              // Successful capture! For dev/demo purposes:
              console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
              const transaction = orderData.purchase_units[0].payments.captures[0];
              alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
              // When ready to go live, remove the alert and show a success message within this page. For example:
              // const element = document.getElementById('paypal-button-container');
              // element.innerHTML = '<h3>Thank you for your payment!</h3>';
              // Or go to another URL:  actions.redirect('thank_you.html');
            });
          },
        }).render('#paypal-button-container');
      </script>
    </div>
  </form>
</div>