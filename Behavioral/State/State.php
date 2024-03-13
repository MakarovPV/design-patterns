<?php
/**
 * Суть шаблона Состояние в том, чтобы последовательно проходить по всем состояниям какого-либо процесса.
   Допустим, в случае создания документа, есть 4 стадии - создание, разработка, тестирование и завершение.
   На каждом этапе происходят какие-то изменения и преобразования документа.
   В каждом классе есть метод, перенаправляющий на следующее состояние, который вызывается из отдельного класса контекста состояния.
   Чем-то пооже на мементо, но наоборот
 */

/**
 * Интерфейс состояния
 */
interface State
{
    public function toNext(Context $context): void;
}

/**
 * Конкретное состояние 1
 */
class Created implements State
{
    public function toNext(Context $context): void
    {
        $context->setState(new Process());
    }
}

/**
 * Конкретное состояние 2
 */
class Process implements State
{
    public function toNext(Context $context): void
    {
        $context->setState(new Test());
    }
}

/**
 * Конкретное состояние 3
 */
class Test implements State
{
    public function toNext(Context $context): void
    {
        $context->setState(new Done());
    }
}

/**
 * Конкретное состояние 4
 */
class Done implements State
{
    public function toNext(Context $context): void
    {

    }
}

/**
 * Контекст
 */
class Context
{
    private State $state;

    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public function setState(State $state): void
    {
        $this->state = $state;
    }

    public function proceedToNext(): void
    {
        $this->state->toNext($this);
    }
}

$state = new Context(new Created());
$state->proceedToNext();
$state->proceedToNext();
$state->proceedToNext(); //проходимся по всем состояниям