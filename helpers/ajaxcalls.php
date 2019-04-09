<?php
defined("ABSPATH") or die("");

//Codigo para guardar la configuracion de mètodos de pago
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_payMethodConfig','payMethodConfig');
add_action('wp_ajax_proyectosadminjs_ajax_payMethodConfig','payMethodConfig');
function payMethodConfig()
{
  $useCulqi = $_POST['use_culqi'];
  $usePaypal = $_POST['use_paypal'];
  
  update_option('use_culqi', $useCulqi);
  update_option('use_paypal', $usePaypal);

  echo true;
  wp_die();
}
//END

//Codigo para guardar la configuracion de mètodos de pago
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_dayForReserve','dayForReserve');
add_action('wp_ajax_proyectosadminjs_ajax_dayForReserve','dayForReserve');
function dayForReserve()
{
  $dayForReserve = $_POST['day_for_reserve'];
  update_option('day_for_reserve', $dayForReserve);

  echo true;
  wp_die();
}
//END

//Codigo para guardar la configuracion de pagina de formulario culqi
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_culqiFormPage','culqiFormPage');
add_action('wp_ajax_proyectosadminjs_ajax_culqiFormPage','culqiFormPage');
function culqiFormPage()
{
  $culqiFormPage = $_POST['culqi_form_page'];
  update_option('culqi_form_page', $culqiFormPage);

  echo true;
  wp_die();
}
//END

//Codigo para guardar la configuracion de pagina de formulario paypal
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_paypalFormPage','paypalFormPage');
add_action('wp_ajax_proyectosadminjs_ajax_paypalFormPage','paypalFormPage');
function paypalFormPage()
{
  $paypalFormPage = $_POST['paypal_form_page'];
  update_option('paypal_form_page', $paypalFormPage);

  echo true;
  wp_die();
}
//END

//Codigo para guardar la configuracion de pagina de formulario de datos
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_dataFormPage','dataFormPage');
add_action('wp_ajax_proyectosadminjs_ajax_dataFormPage','dataFormPage');
function dataFormPage()
{
  $dataFormPage = $_POST['data_form_page'];
  update_option('data_form_page', $dataFormPage);

  echo true;
  wp_die();
}
//END

//Codigo para guardar la configuracion de titulo de formulario home
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_formTitleHome','formTitleHome');
add_action('wp_ajax_proyectosadminjs_ajax_formTitleHome','formTitleHome');
function formTitleHome()
{
  $formTitleHome = $_POST['form_title_home'];
  update_option('form-home-title', $formTitleHome);

  echo true;
  wp_die();
}
//END

//Codigo para guardar la configuracion de titulo de formulario sidebar
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_formTitleSidebar','formTitleSidebar');
add_action('wp_ajax_proyectosadminjs_ajax_formTitleSidebar','formTitleSidebar');
function formTitleSidebar()
{
  $formTitleSidebar = $_POST['form_title_sidebar'];
  update_option('form-sidebar-title', $formTitleSidebar);

  echo true;
  wp_die();
}
//END

//Codigo para guardar la configuracion de slug de pagina de reserva finalizada
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_completedPage','completedPage');
add_action('wp_ajax_proyectosadminjs_ajax_completedPage','completedPage');
function completedPage()
{
  $completedPage = $_POST['completed_page'];
  update_option('completed_page', $completedPage);

  echo true;
  wp_die();
}
//END


//Codigo para obtener nombres de estaciones de trenes y construir rutas
add_action('wp_ajax_nopriv_proyectosmainjs_ajax_getRutas','getRutas');
add_action('wp_ajax_proyectosmainjs_ajax_getRutas','getRutas');
function getRutas()
{
  $idDestino = $_POST['id_destino'];

  $trenesArguments = array(
    'post_type' => 'rt-trains',
    'posts_per_page' => '-1',
    'meta_query' => array( 
      array(
        'key' => 'estacion_llegada',
        'value' => $idDestino,
        'compare' => '=',
      )  
    ),
  );

  $trenes = new WP_Query($trenesArguments);

  $listTrenes = array();
  if ($trenes->have_posts()) {
    while ($trenes->have_posts()) {
      $trenes->the_post();
      $termId = wp_get_post_terms(get_the_ID(), 'origen')[0]->term_id;
      $listTrenes[$termId] = wp_get_post_terms(get_the_ID(), 'origen')[0]->name;
    }
  }

  $trenes = array();
  foreach ($listTrenes as $key => $value) {
    $trenes[] = [$key, $value];
  }
  echo json_encode($trenes);
  wp_die();
}
//END

//Codigo para obtener nombres de estaciones de trenes y construir rutas
add_action('wp_ajax_nopriv_proyectosformjs_ajax_getRutas','getRutasForm');
add_action('wp_ajax_proyectosformjs_ajax_getRutas','getRutasForm');
function getRutasForm()
{
  $idDestino = $_POST['id_destino'];

  $trenesArguments = array(
    'post_type' => 'rt-trains',
    'posts_per_page' => '-1',
    'meta_query' => array( 
      array(
        'key' => 'estacion_llegada',
        'value' => $idDestino,
        'compare' => '=',
      )  
    ),
  );

  $trenes = new WP_Query($trenesArguments);

  $listTrenes = array();
  if ($trenes->have_posts()) {
    while ($trenes->have_posts()) {
      $trenes->the_post();
      $termId = wp_get_post_terms(get_the_ID(), 'origen')[0]->term_id;
      $listTrenes[$termId] = wp_get_post_terms(get_the_ID(), 'origen')[0]->name;
    }
  }

  $trenes = array();
  foreach ($listTrenes as $key => $value) {
    $trenes[] = [$key, $value];
  }
  echo json_encode($trenes);
  wp_die();
}
//END

//Codigo para obtener trenes
add_action('wp_ajax_nopriv_proyectosmainjs_ajax_getTrenes','getTrenes');
add_action('wp_ajax_proyectosmainjs_ajax_getTrenes','getTrenes');
function getTrenes()
{
  $idDestino = $_POST['id_destino'];
  $idOrigen = $_POST['id_origen'];

  $trenesArguments = array(
    'post_type' => 'rt-trains',
    'posts_per_page' => '-1',
    'meta_query' => array( 
      array(
        'key' => 'estacion_llegada',
        'value' => $idDestino,
        'compare' => '=',
      )  
    ),
    'tax_query' => array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'origen',
        'field' => 'term_id',
        'terms' => $idOrigen
      ),
      array(
        'taxonomy' => 'disponibilidad',
        'field' => 'slug',
        'terms' => array('disponible'),
      ),
    ),
  );

  $trenes = new WP_Query($trenesArguments);

  $listTrenes = array();
  if ($trenes->have_posts()) {
    while ($trenes->have_posts()) {
      $trenes->the_post();
      $listTrenes[] = array(
        'id' => get_the_ID(),
        'name' => get_the_title(),
        'empresa' => wp_get_post_terms(get_the_ID(), 'empresa')[0]->name,
        'hora_salida' => get_post_meta(get_the_ID(), 'departure_time', true),
        'hora_llegada' => get_post_meta(get_the_ID(), 'check_in', true),
        'valor_usd' => get_post_meta(get_the_ID(), 'value_train_usd', true),
        'valor_pen' => get_post_meta(get_the_ID(), 'value_train_pen', true),
      );
    }
  }

  $countTrenes = count($listTrenes);
  do {
    $permuted = false;
    for ($i=0; $i<$countTrenes; $i++) {
      if ($listTrenes[$i]['empresa'] < $listTrenes[$i+1]['empresa']) {
        $temporal = $listTrenes[$i+1];
        $listTrenes[$i+1] = $listTrenes[$i]; 
        $listTrenes[$i] = $temporal;
        $permuted = true;
      }
    }
    $isSorted = $permuted ? false : true;
  } while ($isSorted == false);

  echo json_encode($listTrenes);
  wp_die();
}
//END

//Codigo para crear una orden de culqi
add_action('wp_ajax_nopriv_proyectosmainjs_ajax_createOrder','createOrder');
add_action('wp_ajax_proyectosmainjs_ajax_createOrder','createOrder');
function createOrder()
{
  $firstName = $_POST['first_name'];
  $lastName = $_POST['last_name'];
  $dni = $_POST['dni'];
  $telefono = $_POST['telefono'];
  $email = $_POST['email'];
  $codeReserve = $_POST['code_reserve'];
  $amount = $_POST['amount'];
  $expirationDays = get_option('expiration_date_culqi');
  $expirationDate = new \DateTime();
  $expirationDate->add(new  \DateInterval('P'.$expirationDays.'D'));

  $ch = curl_init();

  $fields = array(
    "amount" => $amount,
    "currency_code"   => "PEN",
    "description"     => 'Reserva de tren',
    "order_number"    => $codeReserve,
    "client_details"  => array(
      "first_name"       => $firstName,
      "last_name"        => $lastName,
      "email"            => $email,
      "phone_number"     => $telefono,
    ),
    "expiration_date" => $expirationDate->format('U'),
    "confirm" => false,
  );

  $data = json_encode($fields);

  $header = array();
  $header[] = 'Content-type: application/json';
  $header[] = 'Content-length: '.strlen($data);
  $header[] = 'Authorization: Bearer '.get_option('culqi_private_key');
  
  //url-ify the data for the POST
  foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
  rtrim($fields_string, '&');

	curl_setopt($ch, CURLOPT_URL, "https://api.culqi.com/v2/orders");
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);


	$response = curl_exec($ch);
	curl_close($ch);
		
  print_r($response);
  wp_die();
}
//END

//Codigo para crear una carga con culqi
add_action('wp_ajax_nopriv_proyectosmainjs_ajax_createChargeCulqi','createChargeCulqi');
add_action('wp_ajax_proyectosmainjs_ajax_createChargeCulqi','createChargeCulqi');
function createChargeCulqi()
{
  $token = $_POST['culqi_token'];
  $email = $_POST['culqi_email'];
  $totalPay = $_POST['total_pay'];
  $reserveId = $_POST['reserve_id'];
  $nombres = $_POST['nombres'];
  $apellidos = $_POST['apellidos'];
  $dni = $_POST['dni'];
  $telefono = $_POST['telefono'];

  $ch = curl_init();

  $fields = array(
    "amount" => $totalPay,
    "currency_code" => "USD",
    "email" => $email,
    "source_id" => $token,
    /*"metadata" => array(
      "reserve_id" => $reserveId,
      "nombres" => $nombres,
      "apellidos" => $apellidos,
      "dni" => $dni,
      "telefono" => $telefono
    )*/
  );

  $data = json_encode($fields);

  $header = array();
  $header[] = 'Content-type: application/json';
  $header[] = 'Content-length: '.strlen($data);
  $header[] = 'Authorization: Bearer '.get_option('culqi_private_key');
  
  //url-ify the data for the POST
  foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
  rtrim($fields_string, '&');

	curl_setopt($ch, CURLOPT_URL, "https://api.culqi.com/v2/charges");
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);


	$response = curl_exec($ch);
	curl_close($ch);
		
  print_r($response);
  wp_die();
}
//END

//Codigo para crear una reserva y obtener id
add_action('wp_ajax_nopriv_proyectosmainjs_ajax_createReserve','createReserve');
add_action('wp_ajax_proyectosmainjs_ajax_createReserve','createReserve');
function createReserve()
{
  echo wp_insert_post(array('post_type' => 'reserve-train'));
  wp_die();
}
//END

//Codigo para guardar una reserva
add_action('wp_ajax_nopriv_proyectosmainjs_ajax_saveReserve','saveReserve');
add_action('wp_ajax_proyectosmainjs_ajax_saveReserve','saveReserve');
function saveReserve()
{
  $dataReserve = $_POST['data_reserve'];
  $paymentType = $_POST['payment_type'];

  $status = $paymentType == 'cash' ? 'pending' : 'publish';

  wp_update_post(array(
    'ID' => $dataReserve['codeReserve'],
    'post_type' => 'reserve-train',
    'post_title' => 'Reserva-'.$dataReserve['codeReserve'],
    'post_status' => $status
  ));

  $sendMaid = new SendMail(json_decode($dataReserve));
  
  update_post_meta($dataReserve['codeReserve'], 'data_reserve', $dataReserve);

  echo true;
  wp_die();
}
//END

//Codigo para guardar la configuracion de key publica Culqi
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_saveCulqiPublicKey','saveCulqiPublicKey');
add_action('wp_ajax_proyectosadminjs_ajax_saveCulqiPublicKey','saveCulqiPublicKey');
function saveCulqiPublicKey()
{
  $culqiPublicKey = $_POST['culqi_public_key'];
  update_option('culqi_public_key', $culqiPublicKey);

  echo true;
  wp_die();
}
//END

//Codigo para guardar la configuracion de key privada Culqi
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_saveCulqiPrivateKey','saveCulqiPrivateKey');
add_action('wp_ajax_proyectosadminjs_ajax_saveCulqiPrivateKey','saveCulqiPrivateKey');
function saveCulqiPrivateKey()
{
  $culqiPrivateKey = $_POST['culqi_private_key'];
  update_option('culqi_private_key', $culqiPrivateKey);

  echo true;
  wp_die();
}
//END

//Codigo para guardar la configuracion de dias de expiracion para pago en efectivo
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_saveExpirationDateCulqi','saveExpirationDateCulqi');
add_action('wp_ajax_proyectosadminjs_ajax_saveExpirationDateCulqi','saveExpirationDateCulqi');
function saveExpirationDateCulqi()
{
  $expirationDateCulqi = $_POST['expiration_date_culqi'];
  update_option('expiration_date_culqi', $expirationDateCulqi);

  echo true;
  wp_die();
}
//END

//Codigo para obtener la key publica de culqi
add_action('wp_ajax_nopriv_proyectosmainjs_ajax_getCulqiPublicKey','getCulqiPublicKey');
add_action('wp_ajax_proyectosmainjs_ajax_getCulqiPublicKey','getCulqiPublicKey');
function getCulqiPublicKey()
{
  echo get_option('culqi_public_key');
  wp_die();
}
//END

//Codigo para obtener la key publica de culqi
add_action('wp_ajax_nopriv_proyectosmainjs_ajax_deleteReserve','deleteReserve');
add_action('wp_ajax_proyectosmainjs_ajax_deleteReserve','deleteReserve');
function deleteReserve()
{
  $idReserve = $_POST['id_reserve'];
  wp_delete_post($idReserve, true);

  echo $idReserve;
  wp_die();
}
//END

//Codigo para guardar la configuracion de tipo de entorno PayPal
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_environmentPaypal','environmentPaypal');
add_action('wp_ajax_proyectosadminjs_ajax_environmentPaypal','environmentPaypal');
function environmentPaypal()
{
  $environmentPaypal = $_POST['environment_paypal'];
  update_option('environment_paypal', $environmentPaypal);

  echo true;
  wp_die();
}
//END

//Codigo para guardar la configuracion de cliente id paypal (sandbox)
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_clientIdPaypalSandbox','clientIdPaypalSandbox');
add_action('wp_ajax_proyectosadminjs_ajax_clientIdPaypalSandbox','clientIdPaypalSandbox');
function clientIdPaypalSandbox()
{
  $clientIdPaypalSandbox = $_POST['client_id_paypal_sandbox'];
  update_option('client_id_paypal_sandbox', $clientIdPaypalSandbox);

  echo true;
  wp_die();
}
//END

//Codigo para guardar la configuracion de cliente id paypal (sandbox)
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_clientIdPaypalLive','clientIdPaypalLive');
add_action('wp_ajax_proyectosadminjs_ajax_clientIdPaypalLive','clientIdPaypalLive');
function clientIdPaypalLive()
{
  $clientIdPaypalLive = $_POST['client_id_paypal_live'];
  update_option('client_id_paypal_live', $clientIdPaypalLive);

  echo true;
  wp_die();
}
//END

//Codigo para obtener los datos de configuracion de paypal
add_action('wp_ajax_nopriv_proyectosmainjs_ajax_getPayPalConfig','getPayPalConfig');
add_action('wp_ajax_proyectosmainjs_ajax_getPayPalConfig','getPayPalConfig');
function getPayPalConfig()
{
  $payPalConfig = array();

  $payPalConfig['environment'] = get_option('environment_paypal');
  $payPalConfig['client_id_paypal_sandbox'] = get_option('client_id_paypal_sandbox');
  $payPalConfig['client_id_paypal_live'] = get_option('client_id_paypal_live');
  
  echo json_encode($payPalConfig); 
  wp_die();
}
//END

//Codigo para guardar numero maximo de adultos
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_numberAdults','numberAdults');
add_action('wp_ajax_proyectosadminjs_ajax_numberAdults','numberAdults');
function numberAdults()
{
  $numberAdults = $_POST['number_adults'];

  update_option('number_adults', $numberAdults);
  
  echo 1;
  wp_die();
}
//END

//Codigo para guardar numero maximo de niños
add_action('wp_ajax_nopriv_proyectosadminjs_ajax_numberChildren','numberChildren');
add_action('wp_ajax_proyectosadminjs_ajax_numberChildren','numberChildren');
function numberChildren()
{
  $numberChildren = $_POST['number_children'];

  update_option('number_children', $numberChildren);
  
  echo 1;
  wp_die();
}
//END