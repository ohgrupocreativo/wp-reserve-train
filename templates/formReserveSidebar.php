<form id="form-reserve-sidebar" action="<?=$this->urlAction;?>" method="post">
  <h3><?=get_option('form-sidebar-title')?></h3>
  <div class="box-ida-vuelta">
    <div class="input-ida-vuelta">
      <label for="ida-vuelta">Ida y vuelta</label>
      <input type="radio" name="ida-vuelta" id="ida-vuelta" value="ida-vuelta" checked="checked">
    </div>
    <div class="input-ida">
      <label for="ida">Ida</label>
      <input type="radio" name="ida-vuelta" id="ida" value="ida" >
    </div>
  </div>
  
  <div class="box-destino-ruta">
    <div class="input-destino">
      <label for="destino">Destino</label>
      <select id="destino" name="destino" class="" selected="selected">
        <?php
          $taxonomy = 'origen';
          $origenes = get_terms(['taxonomy' => $taxonomy,'hide_empty' => false,]);
          foreach ($origenes as $value => $key) {
            echo '<option value="'.$key->term_id.'">'.$key->name.'</option>';
          }
        ?>
      </select>
    </div>

    <div class="input-ruta">
      <label for="ruta">Ruta</label>
      <select id="ruta" name="ruta" class="" selected="selected">
        <option value="">Ruta</option>
        <option value="12">Cusco &gt; Machu Picchu</option>
        <option value="43">Ollantaytambo &gt; Machu Picchu</option>
        <option value="61">Urubamba &gt; Machu Picchu</option>
      </select>
    </div>
  </div>

  <div class="box-fechas-numero">
    <div class="input-fecha-ida">
      <label for="fecha-ida">Fecha ida</label>
      <input type="text" name="fecha-ida" id="fecha-ida" value="" placeholder="mm/dd/yyyy" data-min="<?=$this->getMinimunDay();?>">
    </div>

    <div class="input-fecha-vuelta">
      <label for="fecha-vuelta">Fecha vuelta</label>
      <input type="text" name="fecha-vuelta" id="fecha-vuelta" value="" placeholder="mm/dd/yyyy" data-min="<?=$this->getMinimunDay();?>">
    </div>

    <div class="input-numero-adultos">
      <label for="numero-adultos">Numero de adultos</label>
      <select name="numero-adultos" id="numero-adultos">
        <?php
          $numberAdults = get_option('number_adults');
          for ($i=1; $i<=$numberAdults; $i++) {
            echo '<option val="'.$i.'">'.$i.'</option>';
          }  
        ?>
      </select>
    </div>

    <div class="input-numero-ninos">
      <label for="numero-ninos">Numero de niños</label>
      <select name="numero-ninos" id="numero-ninos">
        <?php
          $numberChildren = get_option('number_children');
          for ($i=0; $i<=$numberChildren; $i++) {
            echo '<option val="'.$i.'">'.$i.'</option>';
          }  
        ?>
      </select>
    </div>
  </div>
  
  <!--
  <div class="box-tipo-pago-total">
    <div class="box-tipo-pago">
      <h3>Pagar por:</h3>
      <?php if (get_option('use_culqi') === 'true') { ?>
      <div>
        <label for="culqi">Culqi</label>
        <input type="radio" name="tipo-pago" id="culqi" value="culqi">
      </div>
      <?php } ?>

      <?php if (get_option('use_paypal') === 'true') { ?>
      <div>
        <label for="paypal">PayPal</label>
        <input type="radio" name="tipo-pago" id="paypal" value="paypal">
      </div>
      <?php } ?>
    </div>
    -->

  <!--
    <div class="text-box-total">
      <h3>Total a pagar: </h3>
      <p class="monto-total">
        <span class="value">$100.000,00</span>
      </p>
    </div>
-->
  </div>

  <div class="box-button-pagar sidebar">
    <input type="submit" value="Reservar" id="reservar" name="reservar" class="button-sidebar-reservar">
  </div>
</form>

