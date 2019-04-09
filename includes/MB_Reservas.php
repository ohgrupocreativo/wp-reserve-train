<?php
defined("ABSPATH") or die("");

class MB_Reservas
{
  static  $mbReservas = null;

  private function __construct()
  {
    add_action('add_meta_boxes', array($this, 'addMetaBoxes'));
    add_action( 'save_post', array($this, 'saveTrenMetabox'));
  }

  static function getSelfObject()
  {
    if ( self::$mbReservas === null) {
      self::$mbReservas = new MB_Reservas();
      return self::$mbReservas;
    } else {
      self::$mbReservas;
    }
  }

  function saveTrenMetaBox($post_id)
  {
  }

  function addMetaBoxes() 
  {
    add_meta_box( 
      'reserva-meta-data', 
      'Datos de la reserva', 
      array($this, 'renderMetaBoxes'), 
      'reserve-train', 
      'normal', 
      'high' 
    );
  }

  function renderMetaBoxes($post)
  {
    ?>
      <table class="form-table">
        <tr>
          <th>Código</th>
          <td><?=$post->ID?></td>
        </tr>
        <tr>
          <th>Tipo</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['idaVuelta'] == 'ida-vuelta' ? 'Ida - Vuelta' : 'Vuelta'?></td>
        </tr>
        <tr>
          <th>Fecha ida</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['fechaIda']?></td>
        </tr>
        <?php if (get_post_meta($post->ID, 'data_reserve', true)['fechaVuelta']) { ?>
        <tr>
          <th>Fecha vuelta</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['fechaVuelta']?></td>
        </tr>
        <?php } ?>
        <tr>
          <th>Numero adultos</th>
            <td><?=get_post_meta($post->ID, 'data_reserve', true)['numeroAdultos']?></td>
        </tr>
        <tr>
          <th>Numero niños</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['numeroNinos']?></td>
        </tr>
        <tr>
          <th>Adultos</th>
            <td>
              <table class="data-pasajeros">
                <thead>
                  <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Fecha de nacimiento</th>
                    <th>Tipo de documento </th>
                    <th>Numero de documento</th>
                    <th>Sexo</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $numeroAdultos = get_post_meta($post->ID, 'data_reserve', true)['numeroAdultos'] - 1;
                  for ($i=0; $i<=$numeroAdultos; $i++) {
                    $adultoData = get_post_meta($post->ID, 'data_reserve', true)['adultos'][$i];
                    echo '<tr>';
                    echo '<td>'.$adultoData['nombres'].'</td>';
                    echo '<td>'.$adultoData['apellidos'].'</td>';
                    echo '<td>'.$adultoData['fechaNacimiento'].'</td>';
                    echo '<td>'.$adultoData['tipoDocumento'].'</td>';
                    echo '<td>'.$adultoData['numeroDocumento'].'</td>';
                    echo '<td>'.$adultoData['sexo'].'</td>';
                    echo '<td>'.$adultoData['email'].'</td>';
                    echo '<td>'.$adultoData['telefono'].'</td>';
                    echo '</tr>';
                  }
                ?>
                </tbody>
              </table>
            </td>
        </tr>
        <?php if (get_post_meta($post->ID, 'data_reserve', true)['numeroNinos'] > 0) {  ?>
        <tr>
          <th>Niños</th>
          <td>
            <table class="data-pasajeros">
              <thead>
                <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Fecha de nacimiento</th>
                <th>Tipo de documento </th>
                <th>Numero de documento</th>
                <th>Sexo</th>
              </tr>
              </thead>
              <tbody>
              <?php
                $numeroNinos = get_post_meta($post->ID, 'data_reserve', true)['numeroNinos'] - 1;
                for ($i=0; $i<=$numeroNinos; $i++) {
                  $ninoData = get_post_meta($post->ID, 'data_reserve', true)['ninos'][0];
                  echo '<tr>';
                  echo '<td>'.$ninoData['nombres'].'</td>';
                  echo '<td>'.$ninoData['apellidos'].'</td>';
                  echo '<td>'.$ninoData['fechaNacimiento'].'</td>';
                  echo '<td>'.$ninoData['tipoDocumento'].'</td>';
                  echo '<td>'.$ninoData['numeroDocumento'].'</td>';
                  echo '<td>'.$ninoData['sexo'].'</td>';
                  echo '</tr>';
                }
              ?>
              </tbody>
              </table>
          </td>
        </tr>
        <?php } ?>
        <tr>
          <th>Tren de ida</th>
          <td>
            <strong><?=get_post_meta($post->ID, 'data_reserve', true)['trenIda']['titleTrain']?></strong>
            <p>Empresa: <?=get_post_meta($post->ID, 'data_reserve', true)['trenIda']['empresa']?></p>
            <p>Hora llegada: <?=get_post_meta($post->ID, 'data_reserve', true)['trenIda']['horaLlegada']?></p>
            <p>Hora Salida: <?=get_post_meta($post->ID, 'data_reserve', true)['trenIda']['horaSalida']?></p>
            <p>Valor: <?=get_post_meta($post->ID, 'data_reserve', true)['trenIda']['valueTrainUsd']?> USD</p>
          </td>
        </tr>
        <?php if (get_post_meta($post->ID, 'data_reserve', true)['trenVuelta']['titleTrain']) { ?>
        <tr>
          <th>Tren de vuelta</th>
          <td>
            <strong><?=get_post_meta($post->ID, 'data_reserve', true)['trenVuelta']['titleTrain']?></strong>
            <p>Empresa: <?=get_post_meta($post->ID, 'data_reserve', true)['trenVuelta']['empresa']?></p>
            <p>Hora llegada: <?=get_post_meta($post->ID, 'data_reserve', true)['trenVuelta']['horaLlegada']?></p>
            <p>Hora Salida: <?=get_post_meta($post->ID, 'data_reserve', true)['trenVuelta']['horaSalida']?></p>
            <p>Valor: <?=get_post_meta($post->ID, 'data_reserve', true)['trenVuelta']['valueTrainUsd']?> USD</p>
          </td>
        </tr>
        <?php } ?>
        <tr>
      </table>
      <h3>Datos del pago</h3>
      <table class="form-table">
        <!--
        <th>Total a pagar PEN</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['totalPagoPen']?></td>
        </tr>
        -->
        <th>Total a pagar USD</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['totalPagoUsd']?></td>
        </tr>
        <tr>
          <th>Medio de pago</th>
          <td><?=ucwords(get_post_meta($post->ID, 'data_reserve', true)['medioPago'])?></td>
        </tr>
        <?php if (get_post_meta($post->ID, 'data_reserve', true)['medioPago'] == 'culqi' and 
                  get_post_meta($post->ID, 'data_reserve', true)['dataPay']) { ?>
        <!--
        <tr>
          <th>Moneda</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['dataPay']['currency_code']?></td>
        </tr>
        
        <tr>
          <th>Nombres</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['dataPay']['metadata']['nombres']?></td>
        </tr>
        <tr>
          <th>Apellidos</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['dataPay']['metadata']['apellidos']?></td>
        </tr>
        <tr>
          <th>DNI</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['dataPay']['metadata']['dni']?></td>
        </tr>
        <tr>
          <th>Teléfono</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['dataPay']['metadata']['telefono']?></td>
        </tr>
        -->
        <tr>
          <th>Email</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['dataPay']['email']?></td>
        </tr>
        <tr>
          <th>Código de referencia</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['dataPay']['reference_code']?></td>
        </tr>
        <tr>
          <th>Código de autorización</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['dataPay']['authorization_code']?></td>
        </tr>
        <tr>
          <th>Número de tarjeta</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['dataPay']['source']['card_number']?></td>
        </tr>
        <tr>
          <th>Tarjeta marca</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['dataPay']['source']['iin']['card_brand']?></td>
        </tr>
        <tr>
          <th>Tipo de tarjeta</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['dataPay']['source']['iin']['card_type']?></td>
        </tr>
        <tr>
          <th>Banco</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['dataPay']['source']['iin']['issuer']['name']?></td>
        </tr>
        <tr>
          <th>País</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['dataPay']['source']['iin']['issuer']['country']?></td>
        </tr>
        <?php } else if (get_post_meta($post->ID, 'data_reserve', true)['medioPago'] == 'paypal') { ?>
        <tr>
          <th>Paypal Token</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['paypalData']['paymentToken']?></td>
        </tr>
        <tr>
          <th>Paypal order Id</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['paypalData']['orderID']?></td>
        </tr>
        <tr>
          <th>Paypal payer ID</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['paypalData']['payerID']?></td>
        </tr>
        <tr>
          <th>Paypal payment ID</th>
          <td><?=get_post_meta($post->ID, 'data_reserve', true)['paypalData']['paymentID']?></td>
        </tr>
        <?php } else { ?>
        <tr>
          <th>Tipo de pago:</th>
          <td>Efectivo</td>
        </tr>
        <?php } ?>
      </table>
    <?php
  }

  
}