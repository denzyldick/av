<?php

namespace Framework\Library\Query;

use Framework\Library\Container;
use Framework\Library\Exception\AVException;
use Framework\Library\Query\Statements\Select;
use Framework\Library\Query\Statements\From;
/**
 * Builds a query so that it can be executed instead returning a pdo array it will return
 * an array of the models you asked for.
 * @author Denzyl Dick<denzyl@live.nl>
 * @package Framework\Library\Query
 */
class Builder
{
    private $query;
    private $class_name;
    private $short_name;

    public function __construct(\ReflectionClass $reflectionClass)
    {
        $this->class_name = $reflectionClass->getName();
        $this->short_name = $reflectionClass->getShortName();
    }
    /**
     * @return $this
     */
    public function select() : Builder
    {
        $this->query = (string)new Select();
        return $this;
    }

    /**
     * @param array $from
     * @return $this
     */
    public function from() : Builder
    {
       $this->query .= " ".(string)new From($this->short_name);
       return $this;
    }

    /**
     * @param $clause
     * @return $this
     * @todo How will I implement this.
     */
    public function where($clause) : Builder
    {

        if(is_null($clause) == false) {
            $this->query .= " WHERE ";

            foreach($clause as $value)
            {
                $this->query .= " {$value} ";
            }
        }return $this;
    }
    public function order($order):Builder{
        return $this;
    }
    public function group($group) : Builder
    {
        return $this;
    }
    public function having($having) :Builder
    {
        return $this;
    }

    public function options(array $options = null) : Builder{
        var_dump($options);
        if(is_null($options) == false)
        {
            $this->query .= "{$options[order]} {$options[group]} $options[having]";
        }
        return $this;
    }
    /**
     * @param $limit
     * @return $this
     */
    public function limit($start = null ,$end = null) : Builder
    {
        if(is_null($start) != false && is_null($end) != false) {
            return $this;
        }
        return $this;
    }

    /**
     * Exectute the query and return an
     * array of models
     * @return array
     */
    public function execute() : Array
    {
       $pdo = Container::get('pdo');

        /** @var \PDOStatement $statement */
       $statement = $pdo->prepare($this->query);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS,$this->class_name);
        $obj = $statement->fetchAll();
      return $obj;
    }
}