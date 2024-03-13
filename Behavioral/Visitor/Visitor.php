<?php
/**
 * Посетитель чем-то похож на Обсервера, но наоборот. Тут не наблюдатель подписывается на объекты, а объекты заносятся в класс Посетителя как посещенные
 */

/**
 * Интерфейс посетителя
 */
interface Visitor
{
    public function visitDeveloper(Worker $worker);

    public function visitDesigner(Worker $worker);
}

/**
 * Конкретный посетитель
 */
class ConcreteVisitor implements Visitor
{
    private array $visited = [];

    public function visitDeveloper(Worker $developer)
    {
        $this->visited[] = $developer;
    }

    public function visitDesigner(Worker $designer)
    {
        $this->visited[] = $designer;
    }

    public function getVisited()
    {
        return $this->visited;
    }
}

/**
 * Интерфейс элемента
 */
interface Worker
{
    public function work();

    /**
     * Аналог метода attach в шаблоне Observer
     */
    public function accept(Visitor $visitor);
}

//

/**
 * Конкретный элемент A
 */
class Developer implements Worker
{
    public function work()
    {
        printf('developer is working');
    }

    public function accept(Visitor $visitor)
    {
        $visitor->visitDeveloper($this);
    }
}

/**
 * Конкретный элемент B
 */
class Designer implements Worker
{
    public function work()
    {
        printf('designer is working');
    }

    public function accept(Visitor $visitor)
    {
        $visitor->visitDesigner($this);
    }
}

// Пример использования

// Создаем объект посетителя
$visitor = new ConcreteVisitor();

// Создаем объекты элементов
$developer = new Developer();
$designer = new Designer();


// Посещаем элементы с помощью посетителя
$developer->accept($visitor);
$designer->accept($visitor);

var_dump($visitor->getVisited()); //выведет все посещенные объекты

foreach ($visitor->getVisited() as $worker) {
    $worker->work(); //вызывает метод у всех посещенных объектов
}