<?php
/**
 * Суть шаблона Pool заключается в наличии двух массивов, между которыми, по мере необходимости, циркулируют различные данные.
   В данном примере свободные работники из массива freeworkers по команде отправляются в массив занятых работников и наоборот.
 */

class WorkerPool
{
    private array $freeWorkers = [];
    private array $busyWorkers = [];

    public function getWorker() : Worker
    {
        if(count($this->freeWorkers) === 0){
            $worker = new Worker();
        } else {
            $worker = array_pop($this->freeWorkers);
        }

        $this->busyWorkers[spl_object_hash($worker)] = $worker;
        return $worker;
    }

    public function release($worker)
    {
        $key = spl_object_hash($worker);
        if(isset($this->busyWorkers[$key])){
            unset($this->busyWorkers[$key]);
            $this->freeWorkers[$key] = $worker;
        }
    }
}

class Worker {
    public function work()
    {
        echo 'work';
    }
}

$pool = new WorkerPool();
$worker = $pool->getWorker();
$worker2 = $pool->getWorker();
$worker->work();
$pool->release($worker2);