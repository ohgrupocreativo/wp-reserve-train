<?php
defined("ABSPATH") or die("");

class SendMail
{
  private $dataReserve;
  private $adminEmail;
  private $userEmail;

  function __construct($dataReserve)
  {
    $this->dataReserve = $dataReserve;
    $this->adminEmail = get_option('admin_email');

    if ($this->dataReserve->medioPago == 'culqi') {
      $this->userEmail = $this->dataReserve->dataPay->email;
    } else {
      $this->userEmail = $this->dataReserve->adultos[0]->email;
    }

  }

  function createMessage() {
        
    $message = '<table>';
    $message .= '<tbody>';
    $message .= '<tr><th>Código</th><td>'.$this->dataReserve->codeReserve.'</td></tr>';
    $message .= '<tr><th>Tipo</th><td>'.($this->dataReserve->idaVuelta == 'ida-vuelta' ? 'Ida - Vuelta' : 'Vuelta').'</td></tr>';
    $message .= '<tr><th>Fecha ida</th><td>'.$this->dataReserve->fechaIda.'</td></tr>';
    $message .= '<tr><th>Fecha vuelta</th><td>'.$this->dataReserve->fechaVuelta.'</td></tr>';
    $message .= '<tr><th>Numero adultos</th><td>'.$this->dataReserve->numeroAdultos.'</td></tr>';
    $message .= '<tr><th>Numero niños</th><td>'.$this->dataReserve->numeroNinos.'</td></tr>';
    $message .= '<tr>';
    $message .= '<th>Tren de ida</th>';
    $message .= '<td>';
    $message .= '<strong>'.$this->dataReserve->trenIda->titleTrain.'</strong>';
    $message .= '<p>Empresa: '.$this->dataReserve->trenIda->empresa.'</p>';
    $message .= '<p>Hora llegada: '.$this->dataReserve->trenIda->horaLlegada.'</p>';
    $message .= '<p>Hora Salida: '.$this->dataReserve->trenIda->horaSalida.'</p>';
    $message .= '<p>Valor PEN: '.$this->dataReserve->trenIda->valueTrainPen.'</p>';
    $message .= '<p>Valor USD: '.$this->dataReserve->trenIda->valueTrainUsd.'</p>';
    $message .= '<tr>';
    $message .= '<th>Tren de vuelta</th>';
    $message .= '<td>';
    $message .= '<strong>'.$this->dataReserve->trenVuelta->titleTrain.'</strong>';
    $message .= '<p>Empresa:'.$this->dataReserve->trenVuelta->empresa.'</p>';
    $message .= '<p>Hora llegada: '.$this->dataReserve->trenVuelta->horaLlegada.'</p>';
    $message .= '<p>Hora Salida: '.$this->dataReserve->trenVuelta->horaSalida.'</p>';
    $message .= '<p>Valor PEN: '.$this->dataReserve->trenVuelta->valueTrainPen.'</p>';
    $message .= '<p>Valor USD: '.$this->dataReserve->trenVuelta->valueTrainUsd.'</p>';
    $message .= '</td>';
    $message .= '</tr>';
    $message .= '</td>';
    $message .= '</tr>';
    $message .= '<tr><th>Total a pagar PEN</th><td>'.$this->dataReserve->totalPagoPen.'$PEN</td></tr>';
    $message .= '<th>Total a pagar USD</th><td>'.$this->dataReserve->totalPagoUsd.' $USD</td></tr>';
    $message .= '<tr><th>Medio de pago</th><td>'.ucwords($this->dataReserve->medioPago).'</td></tr>';
    $message .= '</tbody>';
    $message .= '</table>';

    $message .= '<h2>Adultos</h2>';
    $message .= '<table>';
    $message .= '<thead>';
    $message .= '<tr>';
    $message .= '<th>Nombres</th>';
    $message .= '<th>Apellidos</th>';
    $message .= '<th>Fecha de nacimiento</th>';
    $message .= '<th>Nacionalidad</th>';
    $message .= '<th>Tipo de documento</th>';
    $message .= '<th>Número de documento</th>';
    $message .= '<th>Sexo</th>';
    $message .= '<th>Teléfono</th>';
    $message .= '<th>Email</th>';
    $message .= '</tr>';
    $message .= '</thead>';
    $message .= '<body>';
    foreach ($this->dataReserve->adultos as $adulto) {
      $message .= '<tr>';
      $message .= '<td>'.$adulto->nombres.'</td>';
      $message .= '<td>'.$adulto->apellidos.'</td>';
      $message .= '<td>'.$adulto->fechaNacimiento.'</td>';
      $message .= '<td>'.$adulto->nacionalidad.'</td>';
      $message .= '<td>'.$adulto->tipoDocumento.'</td>';
      $message .= '<td>'.$adulto->numeroDocumento.'</td>';
      $message .= '<td>'.$adulto->sexo.'</td>';
      $message .= '<td>'.$adulto->telefono.'</td>';
      $message .= '<td>'.$adulto->email.'</td>';
      $message .= '</tr>';
    }
    $message .= '</body>';
    $message .= '</table>';

    $message .= '<h2>Niños</h2>';
    $message .= '<table>';
    $message .= '<thead>';
    $message .= '<tr>';
    $message .= '<th>Nombres</th>';
    $message .= '<th>Apellidos</th>';
    $message .= '<th>Fecha de nacimiento</th>';
    $message .= '<th>Nacionalidad</th>';
    $message .= '<th>Tipo de documento</th>';
    $message .= '<th>Número de documento</th>';
    $message .= '<th>Sexo</th>';
    $message .= '</tr>';
    $message .= '</thead>';
    $message .= '<body>';
    foreach ($this->dataReserve->ninos as $nino) {
      $message .= '<tr>';
      $message .= '<td>'.$nino->nombres.'</td>';
      $message .= '<td>'.$nino->apellidos.'</td>';
      $message .= '<td>'.$nino->fechaNacimiento.'</td>';
      $message .= '<td>'.$nino->nacionalidad.'</td>';
      $message .= '<td>'.$nino->tipoDocumento.'</td>';
      $message .= '<td>'.$nino->numeroDocumento.'</td>';
      $message .= '<td>'.$nino->sexo.'</td>';
      $message .= '</tr>';
    }
    $message .= '</body>';
    $message .= '</table>';

    return $message;
  }

  function sendMail() 
  {
    $subject = get_bloginfo('name') . ' - Datos de tu reserva';
    $body = $this->createMessage();
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    wp_mail( 
      $this->userEmail, 
      $subject, 
      $body, 
      $headers 
    );

    wp_mail( 
      $this->adminEmail, 
      $subject, 
      $body, 
      $headers 
    );
  }
}

