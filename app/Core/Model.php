<?php

namespace App\Core;

use App\Core\Application;

abstract class Model
{
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public static function tableName(): string;
    abstract public function attributes(): array;

    public function save($data)
    {
        try {
            $this->loadData($data);

            $tableName = $this->tableName();
            $attributes = $this->attributes();

            $params = array_map(fn ($attr) => ":$attr", $attributes);

            $statement = self::prepareSQL("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")", false);

            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }

            $statement->execute();

            return true;
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            return false;
        }
    }

    public static function all()
    {
        $tableName = static::tableName();

        return self::prepareSQL("SELECT * from $tableName")->fetchAll();
    }
    
    public static function find($id)
    {
        $tableName = static::tableName();

        return self::prepareSQL("SELECT * from $tableName WHERE id = $id")->fetch();
    }

    public static function where($field, $value)
    {
        $tableName = static::tableName();

        return self::prepareSQL("SELECT * from $tableName WHERE $field = '$value'")->fetch();
    }

    private static function prepareSQL($sql, $execute = true)
    {
        return Application::$app->db->query($sql, $execute);
    }
}
