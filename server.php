<?php

require 'vendor/autoload.php';

use App\Services\ServerService;

(
    new ServerService()
)->run();