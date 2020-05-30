<?php
/**
 * @var
 */
define('APP_ID_ONESIGNAL', 'YOUR_APP_ID_ONESIGNAL');
define('REST_API_KEY', 'YOUR_REST_API_KEY_FROM_ONESIGNAL');

/**
 * @param string $title
 */
function sendMessage($title = null) {
  $content = array(
    "en" => $title
  );

  $fields = array(
    'app_id' => APP_ID_ONESIGNAL,
    'included_segments' => array(
      'All'
    ),
    'data' => array(
      "foo" => "bar"
    ),
    'contents' => $content
  );
    
  $fields = json_encode($fields);
  print("\nJSON sent:\n");
  print($fields);
    
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charset=utf-8',
    'Authorization: Basic '.REST_API_KEY
  ));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  
  $response = curl_exec($ch);
  curl_close($ch);
  
  return $response;
}

$response = sendMessage("Este mensaje fue enviado como prueba de notificaciones push");
$return["allresponses"] = $response;
$return = json_encode($return);

print("\n\nJSON received:\n");
print($return);
print("\n");
?>