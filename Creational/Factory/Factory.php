<?php
/**
 * Фабрика - шаблон, который позволяет создавать объекты без явного указания их конкретных классов.
 * Вместо этого, фабрика предоставляет интерфейс для создания объектов, скрывая детали их создания от клиентского кода.
 * По сути, фабрика - это просто класс, использующийся для порождения объекта другого класса
 */

class Worker 
{
	private string $name;

	public function setName(string $name) : void
	{
		$this->name = $name;
	}
}

class WorkerFactory
{
	public static function make() : Worker
	{
		return new Worker();
	}
}

$worker = WorkerFactory::make();
$worker->setName('Ivan');