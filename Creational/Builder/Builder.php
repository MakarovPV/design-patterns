<?php
/**
 * Строитель призван переложить создание сложного, многосоставного объекта на плечи других классов,
 * каждый из которых отвечает за создание какой-то конкретной части конечного объекта.

 * Структура Строителя следующая. Есть Директор который содержит один метод, при вызове которого запускаются все методы билдера, создавая конечный объект.
   Есть Продукт - конечный, проектируемый сложный объект, который содержит в себе методы,
   отвечающие за каждую конкретную его часть, в которые будут записаны данные из билдера.
   И есть Билдер, представляющий собой интерфейс Билдер и наследуемый конкретный Билдер, который как раз и выполняет внутри себя всю работу.
   В нём так же есть методы, предназначенные для генерации частей конечного продукта, но с более сложной реализацией,
   которые генерируют или получают какие-то данные, вызывают методы Продукта и передают эти данные в него на хранение и ещё один метод,
   который должен вернуть сам Продукт. Затем, в Директоре вызывается один метод, запускающий их все и возвращающий Продукт при помощи последнего метода Билдера
 */

class Director
{
    public function make(Builder $builder)
    {
    	$builder->setName();
    	$builder->setPrice();
    	$builder->setDescription();

    	return $builder->build();
    }
}

interface Builder 
{
	public function setName();
	public function setPrice();
	public function setDescription();

	public function build();
}

class ProductBuilder implements Builder
{
    private Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function setName()
    {
        $this->product->setName('Наименование');
        return $this;
    }

    public function setPrice()
    {
        $this->product->setPrice('Цена');
        return $this;
    }

    public function setDescription()
    {
        $this->product->setDescription('Описание');
        return $this;
    }

    public function build()
    {
        return $this->product;
    }
}

class Product
{
    private $name;
    private $price;
    private $description;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getInfo()
    {
        return "Продукт: {$this->name}, Цена: {$this->price}, Описание: {$this->description}";
    }
}

$product = new Product();
$builder = new ProductBuilder($product);
$director = new Director();
$message = $director->make($builder);
var_dump($message->getInfo());