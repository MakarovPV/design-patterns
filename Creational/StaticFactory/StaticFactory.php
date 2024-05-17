<?php
/**
 * В отличие от фабричного метода, статичная фабрика реализуется одним классом и методом, создающим объект того класса, имя которого в него передано.
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

class WorkerFactory {
    public static function make($workerTitle) : ?Worker
    {
        $ClassName = strtoupper($workerTitle);
        if(class_exists($ClassName)) return new $ClassName;
        return null;
    }
}

$designer = WorkerFactory::make('designer');
$developer = WorkerFactory::make('developer');

$designer->work();
$developer->work();