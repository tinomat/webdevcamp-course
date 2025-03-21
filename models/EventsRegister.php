<?php

namespace Model;

class EventsRegister extends ActiveRecord
{
    protected static $table = "events_registers";
    protected static $columnsDB = ["id", "event_id", "register_id"];

    public $id;
    public $event_id;
    public $register_id;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->event_id = $args["event_id"] ?? "";
        $this->register_id = $args["register_id"] ?? "";
    }
}
