<?php
/**
 * Обсервер - шаблон, в котором есть класс наблюдатель и класс, за которым наблюдают.
 * Наблюдатель подписывается на наблюдаемого и при каждом обновлении в наблюдаемом классе, наблюдатель получает оповещение
 */

/**
 * Интерфейс наблюдателя
 */
interface Observer
{
    public function update($data);
}

/**
 * Конкретный класс наблюдателя
 */
class ConcreteObserver implements Observer
{
    public function update($data)
    {
        echo "Получено обновление: " . $data . "\n";
    }
}

/**
 * Интерфейс субъекта
 */
interface Subject
{
    /**
     * Прикрепляет наблюдателя
     */
    public function attach(Observer $observer);

    /**
     * Открепляет наблюдателя
     */
    public function detach(Observer $observer);

    /**
     * Оповещает всех наблюдателей
     */
    public function notify($data);
}

/**
 * Конкретный класс субъекта
 */
class ConcreteSubject implements Subject
{
    private $observers = [];

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer)
    {
        $key = array_search($observer, $this->observers);
        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }

    public function notify($data)
    {
        foreach ($this->observers as $observer) {
            $observer->update($data);
        }
    }
}

// Пример использования

// Создаем объекты наблюдателей
$observer1 = new ConcreteObserver();
$observer2 = new ConcreteObserver();

// Создаем объект субъекта
$subject = new ConcreteSubject();

// Подписываем наблюдателей на субъект. Прикрепление наблюдателей происходит именно из класса, за которым наблюдают
$subject->attach($observer1);
$subject->attach($observer2);

// Изменяем состояние субъекта и оповещаем наблюдателей
$subject->notify("Новое обновление!");

// Отписываем одного из наблюдателей от субъекта
$subject->detach($observer2);

// Изменяем состояние субъекта и оповещаем наблюдателей
$subject->notify("Еще одно обновление!");