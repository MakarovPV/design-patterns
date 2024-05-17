<?php
/**
 * Прототип - это, по сути, простое клонирование.
   При использовании фабрик создаются новые объекты, при использовании прототипа работа идёт с одним клонированным объектом
 */

class Prototype
{
    protected $name;
    protected $position;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position): void
    {
        $this->position = $position;
    }
}

class Developer extends Prototype {
    protected $position = 'developer';
}

$developer = new Developer();
$developer2 = clone $developer;
echo $developer2->getPosition();
