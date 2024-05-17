<?php

/**
 * Фасад - шаблон, который просто получает в себя несколько других объектов и содержит в себе метод, вызывающий методы полученых объектов.
 * Это просто класс, который скрывает от пользователя всю сложную реализацию функционала за одним простым методом или несколькими методами.
 */

/**
 * Подсистема 1
 */
class Subsystem1
{
    public function operation1()
    {
        echo "Выполнение операции подсистемы 1\n";
    }
}

/**
 * Подсистема 2
 */
class Subsystem2
{
    public function operation2()
    {
        echo "Выполнение операции подсистемы 2\n";
    }
}

/**
 * Фасад
 */
class Facade
{
    private $subsystem1;
    private $subsystem2;

    public function __construct()
    {
        $this->subsystem1 = new Subsystem1();
        $this->subsystem2 = new Subsystem2();
    }

    public function operation()
    {
        $this->subsystem1->operation1();
        $this->subsystem2->operation2();
    }
}

// Клиентский код
$facade = new Facade();
$facade->operation();




/**
 * Подсистема 1
 */
class Developer
{
    public function startDevelop()
    {
        echo "developer start";
    }

    public function stopDevelop()
    {
        echo "developer start";
    }
}

/**
 * Подсистема 2
 */
class Designer
{
    public function startDesign()
    {
        echo "designer start";
    }

    public function stopDesign()
    {
        echo "designer stop";
    }
}

/**
 * Фасад
 */
class WorkerFacade
{
    private $developer;
    private $designer;

    public function __construct()
    {
        $this->developer = new Developer();
        $this->designer = new Designer();
    }

    public function startWork()
    {
        $this->developer->startDevelop();
        $this->designer->startDesign();
    }

    public function stopWork()
    {
        $this->developer->stopDevelop();
        $this->designer->stopDesign();
    }
}

// Клиентский код
$facade = new WorkerFacade();
$facade->startDevelop();
