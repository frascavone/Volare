<div class="container g-3 p-2 rounded-3">
  <form id="form-ricerca" action="<?php echo ROOT_URL ?>public/?page=search-results" method="get">
    <input class="form-check-input ml-2" id="and-rit" type="checkbox" name="and-rit">Solo andata
    <script>
      var checkbox = document.getElementById('and-rit');
      checkbox.addEventListener('change',attivaRitorno)

      function attivaRitorno(){
        if (document.getElementById('and-rit').checked){
          document.getElementById('data_rit').disabled=true;
        }else{
          document.getElementById('data_rit').disabled=false;
        }
      }
    </script>
    <div class="row justify-content-center m-2">
      <div class="col-6">
        <input type="text" class="form-control" placeholder="Partenza" name="partenza" list="aeroporti" required>
      </div>
      <div class="col-6">
        <input type="text" class="form-control" placeholder="Destinazione" name="arrivo" list="aeroporti" required>
      </div>
      <datalist id="aeroporti">
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
      <div class="col-4">
        <input class="form-control" id="data_and" type="date" min="<?php echo date("Y-m-d"); ?>" name="data_and" value="<?php echo date("Y-m-d"); ?>" required>
      </div>
      <div class="col-4">
        <input class="form-control" id="data_rit" type="date" min="<?php echo date("Y-m-d"); ?>" name="data_rit" required>
      </div>
    </div>
    <div class="row justify-content-around m-2">
      <div class="col-4">
        <input class="form-control" id="adulti" type="number" name="num_adulti" placeholder="adulti" value="1">
      </div>
      <div class="col-4">
        <input class="form-control" id="bambini" type="number" name="num_bambini" placeholder="bambini">
      </div>
      <div class="col-4">
        <input type="hidden" name="page" value="search-results">
        <input type="submit" class="btn btn-warning" id="ricerca-voli" value="Cerca Voli"></input>
      </div>
    </div>
  </form>
</div>