<?php
/**
 * Основная идея шаблона "Прокси" заключается в том, что он создает объект-прокси,
 * который выступает в роли посредника между клиентским кодом и реальным объектом.
 * Прокси может выполнять различные дополнительные функции, такие как контроль доступа,
 * кэширование, ленивая инициализация и т.д., прежде чем делегировать запросы к реальному объекту.
 */

interface Database
{
    public function getData($key);
}

class RealDatabase implements Database
{
    public function getData($key)
    {
        echo "Получение данных из базы данных для ключа: $key\n";
        return "Данные для ключа $key";
    }
}

class ProxyDatabase implements Database
{
    private $realDatabase;
    private $cache = [];

    public function getData($key)
    {
        if (isset($this->cache[$key])) {
            echo "Получение данных из кэша для ключа: $key\n";
            return $this->cache[$key];
        } else {
            if (!$this->realDatabase) {
                $this->realDatabase = new RealDatabase();
            }
            $data = $this->realDatabase->getData($key);
            $this->cache[$key] = $data;
            return $data;
        }
    }
}

// Пример использования
$database = new ProxyDatabase();

// Первый вызов, данные будут получены из реальной базы данных и сохранены в кэше
$data1 = $database->getData("ключ1");
echo $data1 . "\n";
// Вывод: Получение данных из базы данных для ключа: ключ1
//        Данные для ключа ключ1

// Второй вызов, данные будут получены из кэша
$data2 = $database->getData("ключ1");
echo $data2 . "\n";
// Вывод: Получение данных из кэша для ключа: ключ1
//        Данные для ключа ключ1

// Третий вызов, данные будут получены из реальной базы данных и сохранены в кэше
$data3 = $database->getData("ключ2");
echo $data3 . "\n";