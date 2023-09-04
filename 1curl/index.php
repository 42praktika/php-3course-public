<?php
/*$curl = curl_init("http://example.com"); //получаем дескриптор
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
$content = curl_exec($curl);
curl_close($curl);
echo $content;*/

require '../vendor/autoload.php';
$arr = ["name" => "Incognito", "answer" => 42];
$postparam = json_encode($arr);
$curl = curl_init("https://reqbin.com/echo/post/json");
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $postparam);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "Content-type:application/json",
    "Content-length:" . strlen($postparam),
    "User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36"]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$content = curl_exec($curl);
$curlres = curl_getinfo($curl);
echo curl_error($curl);
echo $content;
echo PHP_EOL;
var_dump($curlres);
