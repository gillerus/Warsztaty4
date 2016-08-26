<?php

class Product {

    private $id;
    private $name;
    private $price;
    private $description;
    private $stock;

    public function __construct() {
        $this->id = -1;
    }

//    public function loadFromDB($conn, $id) {
//        $result = $conn->query("SELECT * FROM books" . (is_null($id) ? '' : ' WHERE id=' . $id));
//        $books = [];
//        while ($row = $result->fetch_assoc()) {
//            $books[] = $row;
//        }
//
//        if (!is_null($id)) {
//            return $books[0];
//        } else {
//            return $books;
//        }
//    }
//    public function create($conn, $name, $author, $description) {
//        
//    }
//
//    public function update($conn, $id, $name, $author, $description) {
//        
//    }
//
//    public function deleteFromDB($conn, $id) {
//        
//    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }
}
