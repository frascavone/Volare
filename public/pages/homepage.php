<div class="container g-3 p-2 rounded-3" style="height:80vh;">
  <div class="text-center">
    <h5>Seleziona il tuo volo in Italia...</h5>
    <br>
  </div>
  <form action="<?php echo ROOT_URL ?>public/?page=search-results" method="get">
    <input class="form-check-input ml-2" id="isReturn" type="checkbox" name="isReturn">Solo andata
    <script>
      var checkbox = document.getElementById('isReturn');
      checkbox.addEventListener('change', attivaRitorno)

      function attivaRitorno() {
        if (document.getElementById('isReturn').checked) {
          document.getElementById('dateIn').disabled = true;
        } else {
          document.getElementById('dateIn').disabled = false;
        }
      }
    </script>
    <div class="row justify-content-center m-2">
      <div class="col" id="departure">
        <input type="text" class="form-control" name="departure" list="airports" placeholder="Partenza" required>
      </div>
      <div class="col" id="destination">
        <input type="text" class="form-control" name="destination" list="airports" placeholder="Destinazione" required>
      </div>
      <datalist id="airports">
        <option value="Bari">
        <option value="Bologna">
        <option value="Firenze">
        <option value="Napoli">
        <option value="Milano">
        <option value="Palermo">
        <option value="Roma">
        <option value="Torino">
        <option value="Venezia">
      </datalist>
    </div>
    <div class="row justify-content-center">
      <div class="col-5 col-md-4">
        <input class="form-control p-2" type="date" min="<?php echo date("Y-m-d"); ?>" id="dateOut" name="dateOut" value="<?php echo date("Y-m-d"); ?>" required>
      </div>
      <div class="col-5 col-md-4">
        <input class="form-control p-2" type="date" min="<?php echo date("Y-m-d"); ?>" id="dateIn" name="dateIn" required>
      </div>
    </div>
    <div class="row justify-content-center m-2">
      <div class="col-5 ">
        <div class="row justify-content-center" id="passengers">
          <div class="col-8 p-0">
            <label for="passengers">Passeggeri</label>
          </div>
          <div class="col-4 p-0 mr-1">
            <input class="form-control p-1" type="number" name="passengers" value="1">
          </div>
        </div>
      </div>
      <div class="col-5">
        <input type="hidden" name="page" value="search-results">
        <input type="submit" class="btn btn-warning" value="Cerca Voli"></input>
      </div>
    </div>
  </form>
</div>