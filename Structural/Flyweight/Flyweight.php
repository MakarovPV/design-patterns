<?php
/**
 * Легковес. По сути, это просто фабрика, которая имет в себе массив,
 * в который создаваемые объекты добавляются по мере создания (через эту фабрику) по какому-то id.
 * Если же клиент пытается создать объект с id, по которому в массиве уже хранится объект, то ему вернется уже существующий объект.
 * Объекты с одинаковыми ключами являются одним и тем же объектом.
 */

class FlyweightFactory
{
    private $flyweights = [];

    public function getFlyweight($key)
    {
        if (!isset($this->flyweights[$key])) {
            $this->flyweights[$key] = new ConcreteMail($key);
        }

        return $this->flyweights[$key];
    }
}

interface Mail
{
    public function operation();
}

class ConcreteMail implements Mail
{
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function operation()
    {
        echo "Вызвана операция для ключа: {$this->key}\n";
    }
}

// Пример использования
$factory = new FlyweightFactory();

$flyweight1 = $factory->getFlyweight('key1');
$flyweight1->operation();

$flyweight2 = $factory->getFlyweight('key2');
$flyweight2->operation();

$flyweight3 = $factory->getFlyweight('key1');
$flyweight3->operation();
