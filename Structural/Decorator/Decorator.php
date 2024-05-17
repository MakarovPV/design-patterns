<?php
/**
 * Суть Декоратора в том, что он представляет из себя матрешку,
 * оборачивающую класс в несколько дополняющих его слоев с дополнительной реализацией.
 *
 * Структура следующая. Есть базовый интерфейс, от которого наследуется и класс, над которым будут производиться манипуляции,
 * и иерархия классов-декораторов с абстрактным классом на вершине.
 * В клиентском коде в конструктор какого-то конкретного декоратора помещается класс,
 * реализующий базовый интерфейс (то есть можно и другие декораторы засовывать, создавая ту самую матрешку, которая срабатывает по цепочке при вызове метода).
 * Абстрактный класс декоратора имеет конструктор, который получает объект, расширяющий базовый интерфейс и метод,
 * вызывающий метод переданного объекта (метод необязателен, можно и через свойство обращаться).
 */

/**
 * Интерфейс компонента
 */
interface Component
{
    public function operation();
}


/**
 * Конкретный компонент
 */
class ConcreteComponent implements Component
{
    public function operation()
    {
        echo "Выполнение операции компонента\n";
    }
}


/**
 * Базовый класс декоратора
 */
abstract class Decorator implements Component
{
    protected $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    public function operation()
    {
        $this->component->operation();
    }
}

/**
 * Конкретный декоратор
 */
class ConcreteDecoratorA extends Decorator
{
    public function operation()
    {
        parent::operation();
        $this->addedBehavior();
    }

    public function addedBehavior()
    {
        echo "Добавленное поведение декоратора A\n";
    }
}

class ConcreteDecoratorB extends Decorator
{
    public function operation()
    {
        parent::operation();
        $this->addedBehavior();
    }

    public function addedBehavior()
    {
        echo "Добавленное поведение декоратора B\n";
    }
}

// Клиентский код
$component = new ConcreteComponent();
$decoratorA = new ConcreteDecoratorA($component);
$decoratorB = new ConcreteDecoratorB($decoratorA);

$decoratorB->operation(); //поочередно вызовет метод operation у всех завернутых классов



/**
 * Укороченный пример, предполагающий наличие интерфейса и абстрактного класса
 */
class Text
{
    private $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function render()
    {
        return $this->content;
    }
}

/**
 * Декоратор, добавляющий HTML-теги
 */
class HtmlDecorator
{
    private $text;

    public function __construct(Text $text)
    {
        $this->text = $text;
    }

    public function render()
    {
        $content = $this->text->render();
        return "<p>$content</p>";
    }
}

/**
 * Декоратор, добавляющий CSS-стили
 */
class CssDecorator
{
    private $text;

    public function __construct(Text $text)
    {
        $this->text = $text;
    }

    public function render()
    {
        $content = $this->text->render();
        return "<div style='color: red;'>$content</div>";
    }
}

// Клиентский код
$text = new Text("Привет, мир!");
$htmlDecorator = new HtmlDecorator($text);
$cssDecorator = new CssDecorator($htmlDecorator);

echo $cssDecorator->render();