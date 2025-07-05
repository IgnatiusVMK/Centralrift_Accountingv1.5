<?php

require 'vendor/autoload.php';

$redis = new Predis\Client([
    'scheme' => 'tls',
    'host'   => 'redis-10840.c73.us-east-1-2.ec2.redns.redis-cloud.com',
    'port'   => 10840,
    'username' => 'default',
    'password' => 'NXzwsnhP2ufbQiW41OUjU3WkXM1OYt8e',
]);

$redis->set('direct_test', 'success');
echo "Value: " . $redis->get('direct_test') . "\n";
