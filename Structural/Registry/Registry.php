<?php
/**
 * Реестр - это глобальный массив для всего приложения,
 * в который можно из любого класса положить какие-либо данные и из любого другого класса в проекте их достать.
 */

class Registry {
    private static array $array = [];

    public static function getValue($key)
    {
        if(isset(self::$array[$key])) return self::$array[$key];
        return null;
    }

    public static function setValue($key, $value)
    {
        self::$array[$key] = $value;
    }
}