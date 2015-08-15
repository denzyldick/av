<?php

namespace Framework\Library\Query;


use Framework\Library\Container;
use Framework\Library\Exception\AVException;
use Framework\Library\Query\Statements\Limit;
use Framework\Library\Query\Statements\Select;
use Framework\Library\Query\Statements\From;
use Framework\Library\Query\Statements\Where;

/**
 * This class creates the query to be executed.
 * @author Denzyl Dick<denzyl@live.nl>
 * @package Framework\Library\Query
 */
class Builder
{
    private $query;
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
    public function from($from) : Builder
    {
       $this->query .= " ".(string)new From($from);

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
    public function execute() : bool
    {
       $pdo = (Container::DI()['pdo']);
        /** @var \PDOStatement $statement */
       $statement = $pdo->prepare($this->query);
       return $statement->execute();

    }
}