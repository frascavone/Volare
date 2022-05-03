<h1>Checkout</h1>

<div class="row g-5">
  <div class="col-md-5 col-lg-4 order-md-last">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span>Il tuo carrello</span>
    </h4>
    <ul class="list-group mb-3">
      <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
          <h6 class="my-0">Product name</h6>
          <small class="text-muted">Brief description</small>
        </div>
        <span class="text-muted">$12</span>
      </li>
      <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
          <h6 class="my-0">Second product</h6>
          <small class="text-muted">Brief description</small>
        </div>
        <span class="text-muted">$8</span>
      </li>
      <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
          <h6 class="my-0">Third item</h6>
          <small class="text-muted">Brief description</small>
        </div>
        <span class="text-muted">$5</span>
      </li>
      <li class="list-group-item d-flex justify-content-between">
        <span>Total</span>
        <strong>$20</strong>
      </li>
    </ul>
  </div>
  <div class="col-md-7 col-lg-8">
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

        <h4 class="mb-3">Pagamento</h4>

        <div class="my-3">
          <div class="form-check">
            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
            <label class="form-check-label" for="credit">Carta di Credito/Debito</label>
          </div>
          <div class="form-check">
            <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
            <label class="form-check-label" for="paypal">PayPal</label>
          </div>
        </div>

        <div class="row gy-3">
          <div class="col-md-6">
            <label for="cc-name" class="form-label">Nome sulla carta</label>
            <input type="text" class="form-control" id="cc-name" placeholder="" required>
            <div class="invalid-feedback">
              Nome sulla carta richiesto
            </div>
          </div>

          <div class="col-md-6">
            <label for="cc-number" class="form-label">Numero della carta</label>
            <input type="text" class="form-control" id="cc-number" placeholder="" required>
            <div class="invalid-feedback">
              Numero della carta richiesto
            </div>
          </div>

          <div class="col-md-3">
            <label for="cc-expiration" class="form-label">Scadenza</label>
            <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
            <div class="invalid-feedback">
              Scadenza richiesta
            </div>
          </div>

          <div class="col-md-3">
            <label for="cc-cvv" class="form-label">CVV</label>
            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
            <div class="invalid-feedback">
              Codice di sicurezza richiesto
            </div>
          </div>
        </div>

        <hr class="my-4">

        <div id="smart-button-container">
          <div style="text-align: center;">
            <div id="paypal-button-container">
              <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="Y4P663Q7SCCP8">
                <input type="image" src="https://www.sandbox.paypal.com/it_IT/IT/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal">
                <img alt="" border="0" src="https://www.sandbox.paypal.com/it_IT/i/scr/pixel.gif" width="1" height="1">
              </form>
            </div>
          </div>
        </div>
        <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=EUR" data-sdk-integration-source="button-factory"></script>
        <script>
          function initPayPalButton() {
            paypal.Buttons({
              style: {
                shape: 'pill',
                color: 'gold',
                layout: 'vertical',
                label: 'paypal',

              },

              createOrder: function(data, actions) {
                return actions.order.create({
                  purchase_units: [{
                    "amount": {
                      "currency_code": "EUR",
                      "value": 1
                    }
                  }]
                });
              },

              onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {

                  // Full available details
                  console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                  // Show a success message within this page, e.g.
                  const element = document.getElementById('paypal-button-container');
                  element.innerHTML = '';
                  element.innerHTML = '<h3>Thank you for your payment!</h3>';

                  // Or go to another URL:  actions.redirect('thank_you.html');

                });
              },

              onError: function(err) {
                console.log(err);
              }
            }).render('#paypal-button-container');
          }
          initPayPalButton();
        </script>

      </div>
    </form>
  </div>
</div>