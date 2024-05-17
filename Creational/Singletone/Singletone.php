<?php
/**
 * Одиночка - шаблон, который гарантирует, что класс имеет только один экземпляр, и предоставляет глобальную точку доступа к этому экземпляру.
 */

final class Singleton {
	private static $instance = null;

	protected function __construct() {}
	protected function __clone() {}

	public static function getInstance()
	{
		if(self::$instance === null){
			self::$instance = new self();
		}
		return self::$instance;
	}
}

$single = Singleton::getInstance();
$single2 = Singleton::getInstance(); //обе переменные указывают на один и тот же объект