<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
require_once "src/brand.php";

$server = 'mysql:host=localhost:8889;dbname=shoe_store_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class StoreTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        Store::deleteAll();
    }

    function test_getters()
    {
        $name = 'Oh My Galosh';
        $id = 1;
        $test_store = new Store ($name, $id);

        $result = array($test_store->getName(), $test_store->getId());
        $expected_result = array('Oh My Galosh', 1);
        $this->assertEquals($result, $expected_result);
    }
}





?>
