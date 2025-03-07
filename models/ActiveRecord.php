<?php

namespace Model;

class ActiveRecord
{

    // Database
    protected static $db;
    protected static $table;
    protected static $columnsDB = [];

    // Alerts and messages
    protected static $alerts = [];

    // Conection with database
    public static function setDB($datab)
    {
        self::$db = $datab;
    }

    // Set any type of alert
    public static function sAlert($type, $msg)
    {
        static::$alerts[$type][] = $msg;
    }

    // Get alerts
    public static function gAlerts()
    {
        return self::$alerts;
    }

    // Validation of inherited models
    public function validate()
    {
        static::$alerts = [];
        return static::$alerts;
    }

    // SQL query to create object in memory
    public static function querySQL($query)
    {
        // Query into database
        $res = self::$db->query($query);

        $arr = [];
        // Mientras existan registran obtenidos con fetchAssoc (retorna array asociativo con los registro en la base de datos)
        while ($log = $res->fetch_assoc()) {
            $arr[] = static::createObject($log);
        }

        // Free memory
        $res->free();
        return $arr;
    }

    // Create an object in memory which is the same that in the DB
    protected static function createObject($log)
    {
        // Instanicamos un objeto con el modelo actual
        $object = new static;

        // Iteramos el array con los registro obtenidos de la consulta
        foreach ($log as $key => $value) {

            // Por cada registro preguntamos si la propiedad ($key) existe en el modelo de objeto que creamos
            if (property_exists($object, $key)) {

                // Agregamos a la instancia del objeto la propiedad y su valor correspondiente en cada iteracion
                $object->$key = $value;
            }
        }
        return $object;
    }

    // Identify and unite attributes of DB
    public function attributes()
    {
        // Array para almacenar los atributos
        $attributes = [];
        // Recorremos el array con las columnas en la base de datos
        foreach (static::$columnsDB as $column) {
            // Evaluamos si la columna iterada es el id la salteamos
            if ($column === "id") continue;
            // Creamos array asociativo, la key será la columna y asu vez le asignamos el valor de la misma
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    public function sanitizeAttributes()
    {
        $attributes = $this->attributes();
        $sanitized = [];
        foreach ($attributes as $key => $value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    // Sync DB with Objects in memory
    public function sync($args = [])
    {
        // Iteramos argumentos (informacion que vamos a obtener de un metodo post por ejemplo ($_POST))
        foreach ($args as $key => $value) {
            // si la propiedad iterada existe en el modelo del objeto y su valor no es nulo
            if (property_exists($this, $key) && !is_null($value)) {
                // asignamos a la llave actual el valor correspondiente
                $this->$key = $value;
            }
        }
    }

    // CRUD - Create - Read - Update - Delete //

    // Save or Update log in DB
    public function save()
    {
        // Instanciamos variable para el resultado
        $res = "";
        // Si el id NO es nulo (es decir el objeto con el que estamos trabajando existe en nuestro base de datos)
        if (!is_null($this->id)) {
            // actualizamos
            $res = $this->update();
        } else { // sino (es decir no existe un registro del objeto actual en nuestra db)
            // Creamos uno nuevo
            $res = $this->create();
        }
        return $res;
    }

    // Create a log in DB
    public function create()
    {
        // Almacenamos los atributo sanitizados
        $attributes = $this->sanitizeAttributes();

        // consulta sql, los joins introducen por cada key o valor del array una coma para separlos, en el caso de los valores se indica la doble comilla ya que estos van entre comillas "valor", "valor"
        $query = 'INSERT INTO ' . static::$table . ' ( ' . join(', ', array_keys($attributes)) . ') VALUES ("' . join('","', array_values($attributes)) . '")';

        // Enviamos la consulta y almacenamos resultado
        $res = self::$db->query($query);

        // Retornamos el resultado y el id de la ultima inserción
        return [
            "res" => $res,
            "id" => self::$db->insert_id
        ];
    }

    // Get all logs in current table
    public static function all($order = "DESC")
    {
        $query = "SELECT * FROM " . static::$table . " ORDER BY id {$order}";
        $res = self::querySQL($query);
        return $res;
    }

    // Find a log by his id
    public static function find($id)
    {
        // pedimos todo de la tabla actual donde el id coincida con el parametro indicado
        $query = "SELECT * FROM " . static::$table . " WHERE id = {$id}";
        // enviamos la consulta atraves de nuestro metodo estatico para realizar consultas (este retorna el resultado en un formato objeto)
        $res = self::querySQL($query);
        // como va a retonar un array de objetos, obtenemos solo el primero
        return array_shift($res);
    }

    // Get so many logs as limit indicate
    public static function get($limit, $order = "DESC")
    {
        $query = "SELECT * FROM " . static::$table . " LIMIT {$limit} ORDER BY id {$order}";
        $res = self::querySQL($query);
        return $res;
    }

    // Find logs by column and value
    public static function where($column, $value)
    {
        $query = "SELECT * FROM " . static::$table . " WHERE {$column} = '{$value}'";
        $res = self::querySQL($query);
        return array_shift($res);
    }

    // Update a log
    public function update()
    {
        // obtenemos atributos sanitizados
        $attributes = $this->sanitizeAttributes();

        // array para almacenar el formato clave valor necesario de las columnas a la hora de enviar un UPDATE
        $values = [];
        // recorremos los atributos por su clave valor
        foreach ($attributes as $key => $value) {
            // agregamos a lo ultimo de la array en forma de string, la clave (nombre de la columna) y lo igualamos a su valor el cual va entre comillas
            $values[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$table . " SET " . join(", ", $values) . " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1";
        $res = self::$db->query($query);
        return $res;
    }

    // Delete a log
    public function delete()
    {
        $query = "DELETE FROM " . static::$table . " WHERE id =" . self::$db->escape_string($this->id) . " LIMIT 1";
        $res = self::$db->query($query);
        return $res;
    }
}
