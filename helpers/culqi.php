<?php
$token = $_POST['culqi_token'];
  $email = $_POST['culqi_email'];

  $ch = curl_init();

  $fields = array(
    "amount" => urlencode(1500),
    "currency_code" => urlencode("PEN"),
    "email" => urlencode($email),
    "source_id" => urlencode($token)
  );

  $data = json_encode($fields);

  $header = array();
  $header[] = 'Content-length: '.strlen($data);;
  $header[] = 'Content-type: application/json';
  $header[] = 'Authorization: Bearer sk_test_m2OBJOd1okR2ep8S';
  
  //url-ify the data for the POST
  foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
  rtrim($fields_string, '&');

	curl_setopt($ch, CURLOPT_URL, "https://api.culqi.com/v2/charges");
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "{amount:1500}");
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);


	$response = curl_exec($ch);
	curl_close($ch);
		
  echo json_encode($response);