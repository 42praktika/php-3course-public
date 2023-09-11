<?php

function getData($key) {return 42;}
$m = new Memcached();

$key = 1;

if (!($user = $m->get($key))) {
   $user = getData($key);
   $m->set($key, $user);
}

//... $user