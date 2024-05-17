<?php
/**
 * В отличие от обычной фабрики, которая создает отдельные объекты, абстрактная фабрика предоставляет интерфейс для создания семейств связанных или зависимых объектов.
 * Так же абстрактная фабрика может быть использована для создания различных вариаций объектов в зависимости от контекста или условий,
 * в то время как обычная фабрика  создает объекты одного типа.
 */

interface WorkerFactory {
    public static function makeDeveloperWorker();
    public static function makeDesignerWorker();
}

class NativeWorkerFactory implements WorkerFactory {
    public static function makeDeveloperWorker()
    {
        return new NativeDeveloperWorker();
    }
    public static function makeDesignerWorker()
    {
        return new NativeDesignerWorker();
    }
}

class OutsourceWorkerFactory implements WorkerFactory {
    public static function makeDeveloperWorker()
    {
        return new OutsourceDeveloperWorker();
    }
    public static function makeDesignerWorker()
    {
        return new OutsourceDesignerWorker();
    }
}


interface Worker {
    public function work();
}

interface Developer extends Worker {

}

interface Designer extends Worker {

}

class NativeDeveloperWorker implements Developer {
    public function work()
    {
        echo 'native developer';
    }
}

class OutsourceDeveloperWorker implements Developer {
    public function work()
    {
        echo 'outsource developer';
    }
}

class NativeDesignerWorker implements Designer {
    public function work()
    {
        echo 'native designer';
    }
}

class OutsourceDesignerWorker implements Designer {
    public function work()
    {
        echo 'outsource designer';
    }
}

$outsourceDesigner = OutsourceWorkerFactory::makeDesignerWorker();
$outsourceDeveloper = OutsourceWorkerFactory::makeDeveloperWorker();
$nativeDesigner = NativeWorkerFactory::makeDesignerWorker();
$nativeDeveloper = NativeWorkerFactory::makeDeveloperWorker();

$outsourceDesigner->work();
