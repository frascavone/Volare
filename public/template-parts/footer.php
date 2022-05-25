<?php
$cm = new CartManager();
$cartId =  $cm->getCurrentCartId();
$cartTotal = $cm->getCartTotal($cartId);
?>

<footer class="bg-primary">
  Copiright &#169 2022 fra.scavone
</footer>


<script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
<script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://bootswatch.com/_vendor/prismjs/prism.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/main.js"></script>
<script>
  $(document).ready(function() {
    $('.js-totCartItems').html('<?php echo $cartTotal['passengers'] ?>');
  });
</script>
</body>

</html>