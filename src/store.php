<?php
require_once __DIR__."/../src/brand.php";

class Store
{
    private $name;
    private $id;

    function __construct($name, $id = null)
    {
        $this->name = $name;
        $this->id = $id;
    }

    function getName()
    {
        return $this->name;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $exec = $GLOBALS['DB']->prepare("INSERT INTO stores (name) VALUES (:name)");
        $exec->execute([':name' => $this->getName()]);
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    function addBrand($brand)
    {
        $exec = $GLOBALS['DB']->prepare("INSERT INTO brands_stores (brand_id, store_id) VALUES (:brand_id, :store_id);");
        $exec->execute([':brand_id' => $brand->getId(), ':store_id' => $this->getId()]);
    }

    function getBrands()
    {
        $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores JOIN brands_stores ON  (brands_stores.store_id = stores.id) JOIN brands ON (brands.id = brands_stores.brand_id) WHERE stores.id = {$this->getId()};");
        $brands = [];
        foreach($returned_brands as $brand) {
            $name = $brand['name'];
            $id = $brand['id'];
            $new_brand = new Brand($name, $id);
            array_push($brands, $new_brand);
        }
        return $brands;
    }

    static function find($id)
    {
        $found_store;
        $stores = Store::getAll();
        foreach ($stores as $store) {
            if ($store->getId() == $id) {
               $found_store = $store;
            }
        }
        return $found_store;
    }

    static function getAll()
    {
        $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
        $stores = [];
        foreach ($returned_stores as $store) {
            $name = $store['name'];
            $id = $store['id'];
            $new_store = new Store ($name, $id);
            array_push($stores, $new_store);
        }
        return $stores;
    }

   static function deleteAll()
   {
        $GLOBALS['DB']->exec("DELETE FROM stores;");
   }
}
?>
