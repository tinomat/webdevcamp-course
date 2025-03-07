<?php

namespace Model;

class Event extends ActiveRecord
{
    protected static $tablet = "events";
    protected static $columnsDB = ["id", "name", "descriptin"];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->name = $args["name"] ?? "";
    }
}
