<?php
/**
 * Цепочка обязанностей. Суть шаблона заключается в создании цепочки объектов, вызов которых будет определяться приоритетом или сложностью полученной задачи.
   Например, у нас есть 3 типа разработчиков - джун, мидл и сеньер. В зависимости от полученной задачи, она будет передаваться кому-то одному из них.
   Если приходит легкая задача (request1), то задачу решает джун и дальше она не идет, если чуть сложнее (request2), то её решает мидл,
   если задача самая сложная и её не могут решить джун с мидлом, то она перенаправляется к сеньеру.
 */
abstract class Handler
{
    private ?Handler $nextHandler;

    public function __construct(?Handler $handler)
    {
        $this->nextHandler = $handler;
    }

    public function handleRequest($request)
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handleRequest($request);
        }

        return null;
    }
}

/**
 * Конкретные классы обработчиков
 */
class Junior extends Handler
{
    public function handleRequest($request)
    {
        if ($request === 'request1') {
            return 'Обработчик 1 обработал запрос';
        } else {
            return parent::handleRequest($request);
        }
    }
}

class Middle extends Handler
{
    public function handleRequest($request)
    {
        if ($request === 'request2') {
            return 'Обработчик 2 обработал запрос';
        } else {
            return parent::handleRequest($request);
        }
    }
}

class Senior extends Handler
{
    public function handleRequest($request)
    {
        if ($request === 'request3') {
            return 'Обработчик 3 обработал запрос';
        } else {
            return parent::handleRequest($request);
        }
    }
}

// Использование
$handler3 = new Senior();
$handler2 = new Middle($handler3);
$handler1 = new Junior($handler2);

$result = $handler1->handleRequest('request1');
echo $result; // Вывод: Обработчик 1 обработал запрос

$result = $handler1->handleRequest('request2');
echo $result; // Вывод: Обработчик 2 обработал запрос

$result = $handler1->handleRequest('request3');
echo $result; // Вывод: Обработчик 3 обработал запрос

$result = $handler1->handleRequest('request4');
echo $result; // Вывод: null