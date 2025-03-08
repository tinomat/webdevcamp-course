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
        } else {
            if (strlen($this->name) > 40) {
                self::$alerts["error"][] = "El nombre no puede contener más de 40 caracteres";
            }
        }
        if (!$this->lastname) {
            self::$alerts["error"][] = "Debes ingresar un apellido";
        } else {
            if (strlen($this->lastname) > 40) {
                self::$alerts["error"][] = "El apellido no puede contener más de 40 caracteres";
            }
        }
        if (!$this->city) {
            self::$alerts["error"][] = "Debes ingresar una ciudad";
        } else {
            if (strlen($this->city) > 20) {
                self::$alerts["error"][] = "El nombre de la ciudad no puede contener más de 20 caracteres";
            }
        }
        if (!$this->country) {
            self::$alerts["error"][] = "Debes ingresar un pais";
        } else {
            if (strlen($this->country) > 20) {
                self::$alerts["error"][] = "El nombre del pais no puede contener más de 20 caracteres";
            }
        }
        if (!$this->image) {
            self::$alerts["error"][] = "Debes ingresar una imagen";
        }
        if (!$this->tags) {
            self::$alerts["error"][] = "Debes ingresar algunas areas";
        } else {
            if (strlen($this->name) > 120) {
                self::$alerts["error"][] = "Haz alcanzado el limite de tags";
            }
        }
        return self::$alerts;
    }
}
