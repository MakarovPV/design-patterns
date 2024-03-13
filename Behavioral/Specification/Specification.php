<?php
/**
 * Спецификация проверяет какой-либо объект на соответствие требований. Например, набрал ли студент достаточное количество баллов для поступления в вуз.
*/

interface Specification
{
	public function isNormal(Pupil $pupil) : bool;
}

/**
 * Объект, который будет проходить проверки на соответствие
 */
class Pupil
{
	private int $rate;

	public function __construct(int $rate)
	{
		$this->rate = $rate;
	}

	public function getRate() : int
	{
		return $this->rate;
	}
}

/**
 * Базовая спецификация, проверяющая, проходит ли объект по условию или нет. В данном случае представляет из себя проверку на проходной балл.
 */
class PupilSpecification implements Specification
{
	private int $rate;

	public function __construct(int $rate)
	{
		$this->rate = $rate;
	}

	public function isNormal(Pupil $pupil) : bool
	{
		return $this->rate < $pupil->getRate();
	}
}

/**
 * Спецификация с логическим "и". В неё передаются несколько баазовых спецификаций. Например, студент решил поступить в несколько вузов,
 * но везде разный проходной балл и в этом классе проверяется соответствует ли его проходной балл абсолютно всем спецификациям
 */
class AndSpecification extends AnotherClass
{
	private Specification $specification;

	public function __construct(Specification ...$specification)
	{
		$this->specification = $specification;
	}

	public function isNormal(Pupil $pupil)
	{
		foreach ($this->specification as $specification) {
			if(!$specification->isNormal($pupil)) return false;
		}
		return true;
	}
}


/**
 * Тут уже проверка по логическому "или". Проверяет по аналогии предыдущим классом, но тут должно быть хотя бы одно соответствие
 */
class OrSpecification extends AnotherClass
{
	private Specification $specification;

	public function __construct(Specification ...$specification)
	{
		$this->specification = $specification;
	}

	public function isNormal(Pupil $pupil)
	{
		foreach ($this->specification as $specification) {
			if($specification->isNormal($pupil)) return true;
		}
		return false;
	}
}

/**
 * Тут просто выводит противоположный результат. Если проходит, то false, если нет - true.
 */
class NotSpecification extends AnotherClass
{
	private Specification $specification;

	public function __construct(Specification ...$specification)
	{
		$this->specification = $specification;
	}

	public function isNormal(Pupil $pupil)
	{
		return !$this->specification->isNormal($pupil);
	}
}

$specification = new PupilSpecification(5);
$specification2 = new PupilSpecification(10);

$pupil = new Pupil(8);

$andspecification = new AndSpecification($specification, $specification2);
$orspecification = new OrSpecification($specification, $specification2);
$notspecification = new NotSpecification($specification);

var_dump($andspecification->isNormal($pupil));