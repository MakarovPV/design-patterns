<?php
/**
 * Фабричный метод - то же, что и простая фабрика, только с иерархией классов.
 */

interface Worker {
    public function work();
}

class Designer implements Worker {
    public function work(){
        echo 'designer';
    }
}

class Developer implements Worker {
    public function work(){
        echo 'developer';
    }
}

interface WorkerFactory {
    public static function make();
}

class DesignerFactory implements WorkerFactory {
    public static function make()
    {
        return new Designer();
    }
}

class DeveloperFactory implements WorkerFactory {
    public static function make()
    {
        return new Developer();
    }
}

$designer = DesignerFactory::make();
$developer = DeveloperFactory::make();

$designer->work();
$developer->work();