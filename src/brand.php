<?php

    class Brand
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
            $exec = $GLOBALS['DB']->prepare("INSERT INTO brands (name) VALUES (:name)");
            $exec->execute([':name' => $this->getName()]);
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function find($id)
       {
            $found_brand;
            $brands = Brand::getAll();
            foreach ($brands as $brand) {
                if ($brand->getId() == $id) {
                   $found_brand = $brand;
                }
            }
            return $found_brand;
       }

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = [];
            foreach ($returned_brands as $brand) {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand ($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

       static function deleteAll()
       {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
       }


    }

?>
