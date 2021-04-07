<?php

require __DIR__ . '/vendor/autoload.php';
use \Firebase\JWT\JWT;

 # config values
 $jwtKey = "your client secret";  # Client Secret
 $jwtClientId = "your client id";  # Client Id
 $jwtUserToken = "your user token";  # User Token
 $authUrl = "https://testoauth.expressauth.net/v2/tbsauth";

 # Fetching current epoch time
$ts = time();

# Constructing payload
$payload = array(
    "iss" => $jwtClientId,
    "sub" => $jwtClientId,
    "aud" => $jwtUserToken,
    "iat" => $ts
);

//create JWS 
$jws = JWT::encode($payload, $jwtKey);


//call auth API to get the access token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $authUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authentication: '. $jws
  ]);

// Execute cURL request
$response = curl_exec($ch);
// Close cURL session
curl_close($ch);

echo $response;
?>