<?php

namespace Model;

class Event extends ActiveRecord
{
    protected static $table = "events";
    protected static $columnsDB = ["id", "name", "description", "availables", "category_id", "day_id", "hour_id", "speaker_id"];

    public $id;
    public $name;
    public $description;
    public $availables;
    public $category_id;
    public $day_id;
    public $hour_id;
    public $speaker_id;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->name = $args["name"] ?? "";
        $this->description = $args["description"] ?? "";
        $this->availables = $args["availables"] ?? "";
        $this->category_id = $args["category_id"] ?? null;
        $this->day_id = $args["day_id"] ?? null;
        $this->hour_id = $args["hour_id"] ?? null;
        $this->speaker_id = $args["speaker_id"] ?? null;
    }

    public function validate()
    {
        if (!$this->name) {
            if (!$this->name) {
                self::$alerts["error"][] = "Debes ingresar un nombre";
            } else {
                if (strlen($this->name) > 40) {
                    self::$alerts["error"][] = "El nombre no puede contener más de 40 caracteres";
                }
            }
        }
        if (!$this->description) {
            self::$alerts["error"][] = "Debes ingresar una descripcion";
        }
        if (!$this->category_id || !filter_var($this->category_id, FILTER_VALIDATE_INT)) {
            self::$alerts["error"][] = "Debes elegir una categoría";
        }
        if (!$this->day_id || !filter_var($this->day_id, FILTER_VALIDATE_INT)) {
            self::$alerts["error"][] = "Debes elegir un día";
        }
        if (!$this->hour_id || !filter_var($this->hour_id, FILTER_VALIDATE_INT)) {
            self::$alerts["error"][] = "Debes elegir una hora";
        }
        if (!$this->availables || !filter_var($this->availables, FILTER_VALIDATE_INT)) {
            self::$alerts["error"][] = "Debes añadir una cantidad de lugares";
        }
        if (!$this->speaker_id || !filter_var($this->speaker_id, FILTER_VALIDATE_INT)) {
            self::$alerts["error"][] = "Debes elegir un ponente";
        }
        return self::$alerts;
    }
}
