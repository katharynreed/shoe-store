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

class BrandTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Brand::deleteAll();
    }

    function test_getters()
    {
        $name = 'Soles of the Damned';
        $id = 1;
        $test_brand = new Brand ($name, $id);

        $result = array($test_brand->getName(), $test_brand->getId());
        $expected_result = array('Soles of the Damned', 1);
        $this->assertEquals($result, $expected_result);
    }
}




?>
