<?php

namespace Model;

class User extends ActiveRecord
{
    protected static $table = "users";
    protected static $columnsDB = ["id", "name", "lastname", "email", "password", "confirm", "token", "admin"];

    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $confirm;
    public $token;
    public $admin;

    public $password2;
    public $current_password;
    public $new_password;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->name = $args["name"] ?? "";
        $this->lastname = $args["lastname"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->password2 = $args["password2"] ?? "";
        $this->current_password = $args["current_password"] ?? "";
        $this->new_password = $args["new_password"] ?? "";
        $this->confirm = $args["confirm"] ?? 0;
        $this->token = $args["token"] ?? "";
        $this->admin = $args["admin"] ?? 0;
    }


    // Validate login
    public function validateLogin(): array
    {
        if (!$this->email) {
            self::$alerts["error"][] = "Debes ingresar un email";
        } else {
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                self::$alerts["error"][] = "Formato de email no valido";
            }
        }
        if (!$this->password) {
            self::$alerts["error"][] = "Debes ingresar un contraseña";
        }
        return self::$alerts;
    }

    // Validate acc
    public function validateAcc(): array
    {
        if (!$this->name) {
            self::$alerts["error"][] = "Debes ingresar un nombre";
        }
        if (!$this->lastname) {
            self::$alerts["error"][] = "Debes ingresar un apellido";
        }
        if (!$this->email) {
            self::$alerts["error"][] = "Debes ingresar un email";
        }
        if (!$this->password) {
            self::$alerts["error"][] = "Debes ingresar una contraseña";
        } else {
            if (strlen($this->password) < 6) {
                self::$alerts["error"][] = "Debes ingresar una contraseña con más de 6 caracteres";
            }
            if ($this->password !== $this->password2) {
                self::$alerts["error"][] = "Las contraseñas son distintas";
            }
        }
        return self::$alerts;
    }

    // Validate an email
    public function validateEmail(): array
    {
        if (!$this->email) {
            self::$alerts["error"][] = "Debes ingresar un email";
        } else {
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                self::$alerts["error"][] = "Formato de email no valido";
            }
        }
        return self::$alerts;
    }

    // Validate password
    public function validatePassword(): array
    {
        if (!$this->password) {
            self::$alerts["error"][] = "Debes ingresar una contraseña";
        } else {
            if (strlen($this->password) < 6) {
                self::$alerts["error"][] = "Debes ingresar una contraseña con más de 6 caracteres";
            }
        }
        return self::$alerts;
    }

    // Validate new password
    public function validateNewPassword(): array
    {
        if (!$this->current_password) {
            self::$alerts["error"][] = "Debes ingresar una contraseña";
        } else {
            if (!$this->new_password) {
                self::$alerts["error"][] = "Debes ingresar una nueva contraseña";
            } else {
                if (strlen($this->new_password) < 6) {
                    self::$alerts["error"][] = "Debes ingresar una nueva contraseña con más de 6 caracteres";
                }
            }
        }
        return self::$alerts;
    }

    // Check password
    public function checkPassword(): bool
    {
        // validamos que el password ingresado sea igual al ya almacenado en la base de datos
        return password_verify($this->current_password, $this->password);
    }

    // Hashing password
    public function hashPassword(): void
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Generate a token
    public function createToken(): void
    {
        $this->token = uniqid();
    }
}
