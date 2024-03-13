<?php

/**
 * Принцип работы стратегии следующий. Есть несколько видов стратегий, которые наследуются от общего интерфейса стратегий.
   И есть выборщик стратегии, в который либо через конструктор, либо через метод передается объект класса нужной стратегии и присваивается свойству в выборщике.
   Затем из метода выборщика вызывается метод полученного объекта через собственное свойство.
 */



/**
 * Пример 1: Сортировка массива
 *
   Интерфейс стратегии
 */
interface SortStrategy {
    public function sort(array $data): array;
}

/**
 * Конкретные стратегии сортировки
 *
 * Реализация алгоритма сортировки пузырьком
 */
class BubbleSortStrategy implements SortStrategy {
    public function sort(array $data): array {
        //сортировка
        return $sortedData;
    }
}

/**
 *  Реализация алгоритма быстрой сортировки
 */
class QuickSortStrategy implements SortStrategy {
    public function sort(array $data): array {
        //сортировка
        return $sortedData;
    }
}

/**
 * Класс, который использует стратегию сортировки
 */
class Sorter {
    private $strategy;

    public function __construct(SortStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function setStrategy(SortStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function sortArray(array $data): array {
        return $this->strategy->sort($data);
    }
}

// Пример использования
$data = [4, 2, 1, 3, 5];

$sorter = new Sorter(new BubbleSortStrategy());
$sortedData = $sorter->sortArray($data);
print_r($sortedData); // Вывод отсортированного массива

$sorter->setStrategy(new QuickSortStrategy());
$sortedData = $sorter->sortArray($data);
print_r($sortedData); // Вывод отсортированного массива










//Пример 2: Подсчет стоимости доставки

// Интерфейс стратегии

/**
 *
 */
interface ShippingStrategy {
    public function calculateCost(float $weight): float;
}

// Конкретные стратегии расчета стоимости доставки

/**
 *
 */
class FlatRateShippingStrategy implements ShippingStrategy {
    public function calculateCost(float $weight): float {
        // Расчет стоимости доставки по фиксированной ставке
        // ...
        return $cost;
    }
}

/**
 *
 */
class WeightBasedShippingStrategy implements ShippingStrategy {
    public function calculateCost(float $weight): float {
        // Расчет стоимости доставки на основе веса
        // ...
        return $cost;
    }
}

// Класс, который использует стратегию расчета стоимости доставки

/**
 *
 */
class ShippingCalculator {
    private $strategy;

    public function __construct(ShippingStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function setStrategy(ShippingStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function calculateShippingCost(float $weight): float {
        return $this->strategy->calculateCost($weight);
    }
}

// Пример использования
$weight = 10;

$calculator = new ShippingCalculator(new FlatRateShippingStrategy());
$cost = $calculator->calculateShippingCost($weight);
echo "Стоимость доставки: $cost\n";

$calculator->setStrategy(new WeightBasedShippingStrategy());
$cost = $calculator->calculateShippingCost($weight);
echo "Стоимость доставки: $cost\n";