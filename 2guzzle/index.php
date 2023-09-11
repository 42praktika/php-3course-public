<?php
/*$curl = curl_init("http://example.com"); //получаем дескриптор
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
$content = curl_exec($curl);
curl_close($curl);
echo $content;*/

use GuzzleHttp\Client;

require '../vendor/autoload.php';

$client = new Client(["base_uri" => "http://httpbin.org"]);

//$response = $client->get("get", ["query"=> ["arg1"=>42, "arg2"=>"guzzle is cool!"]]);
//$response = $client->request("GET", "get",["query"=>["arg1"=>42, "arg2"=>"guzzle is cool!"]] );

try {
    $response = $client->post("post",
        ["form_params" =>
            ["whoami" => "Практика 42"],
            "query"=>["token"=>"DEAD"],
            "body"=>"holly"
        ]);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    echo "Exception: ", $e->getMessage();
    exit;
}

echo "Status code: ", $response->getStatusCode(), PHP_EOL;
echo "Status: ", $response->getReasonPhrase(), PHP_EOL;
$length = $response->getHeader("Content-Length")[0];
echo "Response length: ", $length, PHP_EOL;
$body = ($response->getBody());

echo json_encode(json_decode($body), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


