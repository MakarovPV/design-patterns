<?php
/**
 * Плавучий интерфейс - это шаблон, обеспечивающий возможность цепочки вызовов методов, каждый из которых возвращает ссылку на объект,
 * на котором он был вызван. Это позволяет последовательно вызывать методы на одном объекте без необходимости повторного указания имени объекта.
 */

class QueryBuilder
{
    private $select = [];
    private $from = [];
    private $where = [];

    public function from($table)
    {
        $this->table = $table;
        return $this;
    }

    public function select(array $select)
    {
        $this->select = $select;
        return $this;
    }

    public function where(array $where)
    {
        $this->where = $where;
        return $this;
    }

    public function get()
    {
        return sprintf('SELECT %s FROM %s WHERE %s;',
            join(',', $this->select),
            join(',', $this->from),
            join(' AND ', $this->where),
        );
    }
}

// Пример использования
$queryBuilder = new QueryBuilder();
$query = $queryBuilder->select(['title', 'id'])->from('posts')->where(['views > 20'])->get();