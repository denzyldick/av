<?php

namespace Framework\Library\Query;


use Framework\Library\Container;
use Framework\Library\Model;
use Framework\Library\ModelInterface;
use Framework\Model\User;
use Framework\Library\Query\Statements\Select;
use Framework\Library\Query\Statements\From;
/**
 * This class creates the query to be executed.
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
    {   $this->query = (string)new Select();

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
        if(is_null($clause) != false) {
        $this->query .= " WHERE ";
        }return $this;

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
    }
    public function execute() : Array
    {
       $pdo = (Container::DI()['pdo']);
        /** @var \PDOStatement $statement */
       $statement = $pdo->prepare($this->query);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS,$this->class_name);
        $obj = $statement->fetchAll();
      return $obj;

    }
}