<?php

/**
 * Important pages
 */

use System\config;
use System\input;
use System\route;
use System\uri;
use System\response;


Route::get('/', function () {

return new Template('maintenance');

});
