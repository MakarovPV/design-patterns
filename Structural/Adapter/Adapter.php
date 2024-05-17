<?php
/**
 * Адаптер - класс, который призван унифицировать наименования нескольких других классов,
 * подогнав их под единый шаблон расширяемого интерфейса.
 *
 * Допустим, есть 3 класса A,B,C. В первых двух есть метод, который называется calculate, а в третьем классе схожий метод называется calc.
 * И вот для того, чтобы привести все наименования методов к общемы виду, вместо того, чтобы постоянно в каждом новом классе менять его вручную,
 * (так же редактируя все прочие методы, ссылающиеся на него), мы просто создаем Адаптер, который, по сути, является своеобразной прослойкой.
 * Он получает через конструктор целевой класс, который надо адаптировать, и внутри себя реализует метод calculate,
 * просто вызывающий метод calc из адаптируемого класса.
 */

/**
 * Целевой интерфейс
 */
interface ShippingProvider
{
    public function calculateShipping($weight);
}


/**
 * Адаптируемый класс
 */
class FedEx
{
    public function calculateShippingFee($weight)
    {
        return $weight * 2.5;
    }
}

/**
 * Адаптер
 */
class FedExAdapter implements ShippingProvider
{
    private $fedEx;

    public function __construct(FedEx $fedEx)
    {
        $this->fedEx = $fedEx;
    }

    public function calculateShipping($weight)
    {
        return $this->fedEx->calculateShippingFee($weight);
    }
}

// Клиентский код
$fedEx = new FedEx();
$shippingProvider = new FedExAdapter($fedEx);
$shippingFee = $shippingProvider->calculateShipping(10);
echo "Стоимость доставки: $shippingFee\n";