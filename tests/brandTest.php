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

    function test_save_getAll()
    {
        // Arrange
        $name_one = 'Soles of the Damned';
        $test_brand_one = new Brand ($name_one);
        $test_brand_one->save();

        $name_two = 'Cleft-Toe Maniac';
        $test_brand_two = new Brand ($name_two);
        $test_brand_two->save();
        // Act
        $result = Brand::getAll();
        $expected_result = array($test_brand_one, $test_brand_two);
        // Assert
        $this->assertEquals($result, $expected_result);
    }

    function test_find()
    {
        // Arrange
        $name_one = 'Soles of the Damned';
        $test_brand_one = new Brand ($name_one);
        $test_brand_one->save();

        $name_two = 'Cleft-Toe Maniac';
        $test_brand_two = new Brand ($name_two);
        $test_brand_two->save();
        // Act
        $result = Brand::find($test_brand_one->getId());
        // Assert
        $this->assertEquals($test_brand_one, $result);
    }
}




?>
