<h1>test</h1>
<?php
$cm = new CartManager();
$cartId =  $cm->getCurrentCartId();
?>
<button onclick="removeCart($cartId);">cancella carrello</button>