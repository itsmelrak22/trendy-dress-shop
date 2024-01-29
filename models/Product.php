<?php

Class Product extends Model {

    protected $table = 'products';


    public static function getProductsWithColors(){
        $intance = new self;
        $products = $intance->setQuery("SELECT  A.*
                                FROM products AS A 
                                WHERE A.status = 'product' ")->getAll();


        foreach ($products as $key => $product) {
            $product_id = $product['product_id'];
            $colors = $intance->setQuery("SELECT * FROM `product_colors` WHERE `product_id` = $product_id")->getAll();
            $products[$key]["colors"] = $colors;
        }

        return $products;
    }

}