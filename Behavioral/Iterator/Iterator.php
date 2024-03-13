<?php

/** Итератор позволяет последовательно обходить элементы коллекции без раскрытия ее внутренней структуры.

   Есть класс, который получает в себя массив данных или объектов и может выводить их либо по переданному ключу,
   либо по собственному индексу, который можно увеличивать и уменьшать
*/

class WorkerList
{
	private array $list = [];
	private int $index = 0;
	
	public function getList()
	{
		return $this->list;
	}

	public function setList(array $list)
	{
		$this->list = $list;
	}

	public function getItem($key) : ?Worker
	{
		if($this->list[$key]){
			return $this->list[$key];
		}
		return null;
	}
	
	public function next()
	{
		if($this->index < count($this->list) -1){
			$this->index++;
		}
	}

	public function prev()
	{
		if($this->index > 0){
			$this->index--;
		}
	}

	public function getByIndex()
	{
		return $this->list[$this->index];
	}
}

class Worker
{
	private string $name = '';

	public function __construct(string $name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}
}

$worker = new Worker('Boris');
$worker2 = new Worker('Ivan');
$worker3 = new Worker('Semen');

$list = new WorkerList();
$list->setList([$worker, $worker2, $worker3]);

var_dump($list->getByIndex()->getName()); //выведет имя первого рабочего
$list->next(); //увеличит индекс на 1 и при следующем вызове getByIndex выведет следующего работника