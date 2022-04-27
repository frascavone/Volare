<?php
$cm = new CartManager();
$cartId =  $cm->getCurrentCartId();
$cart_total = $cm -> getCartTotal($cartId);
?>
  
<footer> 
  <hr>
  Copiright &#169 <?php echo date("Y"); ?> fra.sca
</footer>
  
  
<script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
<script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://bootswatch.com/_vendor/prismjs/prism.js"></script>

<script src="<?php echo ROOT_URL ?>assets/js/main.js"></script>
<script>
  $(document).ready(function(){
    $('.js-totCartItems').html('<?php echo $cart_total['num_flights'] ?>');
  });

</script>
</body>
</html>