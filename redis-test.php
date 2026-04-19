<?php

require 'vendor/autoload.php';

use Illuminate\Support\Facades\Redis;

Redis::set('direct_test', 'success');

echo Redis::get('direct_test');;

# Invalidated all previously exposed keys