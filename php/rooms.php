<?php
const TAB_NAME="Rooms";

public class Rooms{
    private $name;
    private $price;
    private $images;
    public function __construct($name,$price, $images){
        $this->name=$name;
        $this->price=$price;
        $this->images=$images;
    }
    public function getName(){
        return $this->name;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getImages(){
        return $this->images;
    }
    $rooms=[
        new Rooms("Standard Room",250,["foto/standard_room1.jpg", "foto/standard_room2.jpg"]),
        new Rooms("Luxory Room",1500,["foto/luxury_room1.jpg", "foto/luxury_room2.jpg"]),
        new Rooms("Private Villas",900,["foto/standard_room1.jpg", "foto/standard_room2.jpg"]),
        new Rooms("Family Room",750,["foto/family_room1.jpg", "foto/family_room2.jpg"]),
        new Rooms("Wellness Suite",1250,["foto/wellness_suite1.jpg", "foto/wellness_suite2.jpg"])
    ];
} 
?>