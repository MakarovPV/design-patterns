<?php
/**
 * Суть шаблона Мементо в хранении состояний какого-либо объекта с возможностью вернуться к любому из них
*/

/**
 * Оригинальный класс, состояние которого нужно сохранить
 */
class Originator
{
    private $state;

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    public function saveStateToMemento()
    {
        return new Memento($this->state);
    }

    public function restoreStateFromMemento(Memento $memento)
    {
        $this->state = $memento->getState();
    }
}


/**
 * Класс, представляющий состояние, которое нужно сохранить
 */
class Memento
{
    private $state;

    public function __construct($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }
}

/**
 * Класс, который управляет сохранением и восстановлением состояния
 */
class Caretaker
{
    private $mementos = [];

    public function addMemento(Memento $memento)
    {
        $this->mementos[] = $memento;
    }

    public function getMemento($index)
    {
        return $this->mementos[$index];
    }
}

// Использование
$originator = new Originator();
$caretaker = new Caretaker();

$originator->setState("Состояние 1");
$originator->setState("Состояние 2");
$caretaker->addMemento($originator->saveStateToMemento());

$originator->setState("Состояние 3");
$caretaker->addMemento($originator->saveStateToMemento());

$originator->setState("Состояние 4");

$originator->restoreStateFromMemento($caretaker->getMemento(0));
echo "Текущее состояние: " . $originator->getState() . "\n";

$originator->restoreStateFromMemento($caretaker->getMemento(1));
echo "Текущее состояние: " . $originator->getState() . "\n";