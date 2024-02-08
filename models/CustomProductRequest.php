<?php

Class CustomProductRequest extends Model {

    protected $table = 'custom_product_requests';

    public static function getCustomRequests(){
        $self = new self;

        return $self->setQuery("SELECT A.* , B.customer_name, B.customer_email
                FROM custom_product_requests A 
                LEFT JOIN customers B
                ON A.customer_id = B.customer_id")
                ->getAll();
    }
    public static function getCustomRequest($id){
        $self = new self;

        return $self->setQuery("SELECT A.* , B.customer_name, B.customer_email
                FROM custom_product_requests A 
                LEFT JOIN customers B
                ON A.customer_id = B.customer_id
                WHERE A.id = $id
                ")
                ->getFirst();
    }
}