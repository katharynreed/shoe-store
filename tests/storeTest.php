<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
require_once "src/store.php";

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

    function test_setters()
    {

        $name = 'Oh My Galosh';
        $id = 1;
        $test_store = new Store ($name, $id);
        $test_store->setName('Shoes R Us');

        $result = array ($test_store->getName());
        $expected_result = array('Shoes R Us');

        $this->assertEquals($result, $expected_result);
    }

    function test_save_getAll()
    {
        $name_one = 'Oh My Galosh';
        $test_store_one = new Store ($name_one);
        $test_store_one->save();

        $name_two = 'Dark Soles';
        $test_store_two = new Store ($name_two);
        $test_store_two->save();

        $result = Store::getAll();
        $expected_result = array($test_store_one, $test_store_two);

        $this->assertEquals($result, $expected_result);
    }

    function test_find()
    {
        // Arrange
        $name_one = 'Oh My Galosh';
        $test_store_one = new Store ($name_one);
        $test_store_one->save();

        $name_two = 'Dark Soles';
        $test_store_two = new Store ($name_two);
        $test_store_two->save();
        // Act
        $result = Store::find($test_store_one->getId());
        // Assert
        $this->assertEquals($test_store_one, $result);
    }

    function test_updateName()
        {
            $name = "Oh My Galosh";
            $test_store = new Store ($name);
            $test_store->save();

            $new_name = "Shoes R Us";
            $test_store->updateName($new_name);

            $result = Store::getAll();
            $this->assertEquals($new_name, $result[0]->getName());
        }

    function test_getBrands()
    {
        $name_one = 'Soles of the Damned';
        $test_brand = new Brand ($name_one);
        $test_brand->save();

        $name_two = 'Cleft-Toe Maniac';
        $test_brand2 = new Brand ($name_two);
        $test_brand2->save();

        $name = "Oh My Galosh";
        $test_store = new Store ($name);
        $test_store->save();

        $test_store->addBrand($test_brand);
        $test_store->addBrand($test_brand2);

        $result = $test_store->getBrands();
        $this->assertEquals([$test_brand, $test_brand2], $result);
    }
}





?>
