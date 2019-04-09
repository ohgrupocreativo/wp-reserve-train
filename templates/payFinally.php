<div class="pay-success">
  <h2>Felicitaciones, tu reserva ha sido realizada con éxito!</h2>
  <table>
    <caption>
      <h3>Datos de la reserva.</h3>
    </caption>
    <tbody>
      <tr>
        <th>Código</th>
        <td><?=$this->getData()->codeReserve?></td>
      </tr>
      <tr>
        <th>Tipo</th>
        <td><?=$this->getData()->idaVuelta == 'ida-vuelta' ? 'Ida - Vuelta' : 'Vuelta'?></td>
      </tr>
      <tr>
        <th>Fecha ida</th>
        <td><?=$this->getData()->fechaIda?></td>
      </tr>
      <?php if($this->getData()->fechaVuelta) { ?>
      <tr>
        <th>Fecha vuelta</th>
        <td><?=$this->getData()->fechaVuelta?></td>
      </tr>
      <?php } ?>
      <tr>
        <th>Numero adultos</th>
          <td><?=$this->getData()->numeroAdultos?></td>
      </tr>
      <tr>
        <th>Numero niños</th>
        <td><?=$this->getData()->numeroNinos?></td>
      </tr>
      
      <tr>
        <th>Tren de ida</th>
        <td>
          <strong><?=$this->getData()->trenIda->titleTrain?></strong>
          <p>Empresa: <?=$this->getData()->trenIda->empresa?></p>
          <p>Hora llegada: <?=$this->getData()->trenIda->horaLlegada?></p>
          <p>Hora Salida: <?=$this->getData()->trenIda->horaSalida?></p>
          <p>Valor PEN: <?=$this->getData()->trenIda->valueTrainPen?></p>
          <p>Valor USD: <?=$this->getData()->trenIda->valueTrainUsd?></p>
        </td>
      </tr>
      
      <?php if($this->getData()->trenVuelta->titleTrain) { ?>
      <tr>
        <th>Tren de vuelta</th>
        <td>
          <strong><?=$this->getData()->trenVuelta->titleTrain?></strong>
          <p>Empresa: <?=$this->getData()->trenVuelta->empresa?></p>
          <p>Hora llegada: <?=$this->getData()->trenVuelta->horaLlegada?></p>
          <p>Hora Salida: <?=$this->getData()->trenVuelta->horaSalida?></p>
          <p>Valor PEN: <?=$this->getData()->trenVuelta->valueTrainPen?></p>
          <p>Valor USD: <?=$this->getData()->trenVuelta->valueTrainUsd?></p>
        </td>
      </tr>
      <? } ?>
      <tr>
        <!--
      <th>Total a pagar PEN</th>
        <td><?=$this->getData()->totalPagoPen?> $PEN</td>
      </tr>
        -->
      <th>Total a pagar USD</th>
        <td><?=$this->getData()->totalPagoUsd?> $USD</td>
      </tr>
      <tr>
        <th>Medio de pago</th>
        <td><?=ucwords($this->getData()->medioPago)?></td>
      </tr>
      </tbody>
  </table>
  <div class="extra-message">
    <p>Toda la información de la reserva será enviada a tu correo electrónico.</p>
  </div>
  <a class="go-to-home" href="<?=get_site_url()?>">Volver al inicio</a>
</div>