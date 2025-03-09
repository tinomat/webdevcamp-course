<?php

namespace Model;

class EventTime extends ActiveRecord
{
    protected static $table = "events";
    protected static $columnsDB = ["id", "category_id", "day_id", "hour_id"];

    public $id;
    public $category_id;
    public $day_id;
    public $hour_id;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->category_id = $args["category_id"] ?? null;
        $this->day_id = $args["day_id"] ?? null;
        $this->hour_id = $args["hour_id"] ?? null;
    }
}
