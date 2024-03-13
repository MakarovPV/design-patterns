<?php
/**
 * Шаблонный метод определяет скелет алгоритма в базовом классе, позволяя подклассам переопределить некоторые шаги алгоритма без изменения его структуры.
 * Например, есть набор методов, которые определяются в родительском, абстрактном классе, но есть один, который каждый дочерний класс реализует по своему.
 */

/**
 * Абстрактный класс с шаблонным методом
 */
abstract class AbstractClass
{
    public function templateMethod()
    {
        $this->printHeader();
        $this->printBody();
        $this->printFooter();
        $this->printCustom();
    }

    private function printHeader()
    {
        printf('header' . PHP_EOL);
    }

    
    private function printBody()
    {
        printf('body' . PHP_EOL);
    }

    private function printFooter()
    {
        printf('footer' . PHP_EOL);
    }
}

/**
 * Конкретный класс, наследующий абстрактный класс
 */
class ConcreteClass1 extends AbstractClass
{
    protected function printCustom()
    {
        printf('custom1' . PHP_EOL);
    }

}

class ConcreteClass2 extends AbstractClass
{
    protected function printCustom()
    {
        printf('custom2' . PHP_EOL);
    }

}

// Пример использования

// Создаем объект конкретного класса
$object = new ConcreteClass1();
$object2 = new ConcreteClass2();

// Вызываем шаблонный метод
$object->templateMethod();