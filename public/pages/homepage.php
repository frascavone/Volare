<div class="container g-3 p-2 rounded-3">
  <div class="text-center">
    <h5>Seleziona il tuo volo in Italia...</h5>
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
      <div class="col-6">
        <input type="text" class="form-control" name="departure" list="airports" placeholder="Partenza" required>
      </div>
      <div class="col-6">
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
      <div class="col-5">
        <input class="form-control" type="date" min="<?php echo date("Y-m-d"); ?>" id="dateOut" name="dateOut" value="<?php echo date("Y-m-d"); ?>" required>
      </div>
      <div class="col-5">
        <input class="form-control" type="date" min="<?php echo date("Y-m-d"); ?>" id="dateIn" name="dateIn" required>
      </div>
    </div>
    <div class="row justify-content-center m-2">
      <div class="col-5 d-flex flex-direction-row justify-content-end">
        <div class="row">
          <div class="col-7">
            <label for="passengers">Passeggeri</label>
          </div>
          <div class="col-5">
            <input class="form-control" type="number" name="passengers" value="1">
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