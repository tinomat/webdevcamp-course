<?php

namespace Model;

class Speaker extends ActiveRecord
{
    protected static $table = "speakers";
    protected static $columnsDB = ["id", "name", "lastname", "city", "country", "image", "tags", "networks"];

    public $id;
    public $name;
    public $lastname;
    public $city;
    public $country;
    public $image;
    public $tags;
    public $networks;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->name = $args["name"] ?? "";
        $this->lastname = $args["lastname"] ?? "";
        $this->city = $args["city"] ?? "";
        $this->country = $args["country"] ?? "";
        $this->image = $args["image"] ?? "";
        $this->tags = $args["tags"] ?? "";
        $this->networks = $args["networks"] ?? "";
    }

    public function validate()
    {
        if (!$this->name) {
            self::$alerts["error"][] = "Debes ingresar un nombre";
        }
        if (!$this->lastname) {
            self::$alerts["error"][] = "Debes ingresar un apellido";
        }
        if (!$this->city) {
            self::$alerts["error"][] = "Debes ingresar una ciudad";
        }
        if (!$this->country) {
            self::$alerts["error"][] = "Debes ingresar un pais";
        }
        if (!$this->image) {
            self::$alerts["error"][] = "Debes ingresar una imagen";
        }
        if (!$this->tags) {
            self::$alerts["error"][] = "Debes ingresar algunas areas";
        }
        return self::$alerts;
    }
}
