<?php

namespace App\Core;

use App\Core\Application;

abstract class Model
{
    public function loadData($data) {
        foreach($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function tablaName(): string;
    abstract public function attributes(): array;

    public function save($data)
    {
        try {
            $this->loadData($data);

            $tableName = $this->tablaName();
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

    public static function prepareSQL($sql, $execute) {
        return Application::$app->db->query($sql, $execute);
    }
}
