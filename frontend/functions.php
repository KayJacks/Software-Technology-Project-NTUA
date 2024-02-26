<?php
  function sendRequest($api_url, $request_method) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => $api_url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $request_method,
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
  }

  function setAPIName(){
    if (getenv('HOST_NAME') !== false){
      $host_ip = getenv('HOST_NAME');
    }
    else {
    $host_ip = 'localhost';
  }
  return $host_ip;
}
?>
