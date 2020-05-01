<?php
/**
 * @package  Blog API
 * @version  1.0
 * @author   Muhammad Raza
 */
require_once 'vendor/autoload.php';

use App\Router\Router;

try {
    //Create Router object and call its main method
    $router = new Router();
    $router->main();

} catch (Exception $ex) {

    echo "Uncaught " . get_class($ex) . ", code: " . $ex->getCode() . "<br />Message: " . htmlentities($ex->getMessage()) . PHP_EOL;
    error_log($ex);
}

?>
