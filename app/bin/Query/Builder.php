<?php

namespace Framework\Library\Query;


use Framework\Library\Container;
use Framework\Library\Exception\AVException;
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
    /**
     * @return $this
     */
    public function select()
    {   $this->query = (string)new Select();

        return $this;
    }

    /**
     * @param array $from
     * @return $this
     */
    public function from($from)
    {
       $this->query .= " ".(string)new From($from);

        return $this;
    }

    /**
     * @param $clause
     * @return $this
     * @todo How will I implement this.
     */
    public function where($clause)
    {
        return $this;
    }

    /**
     * @param $limit
     * @return $this
     */
    public function limit($start,$end = null)
    {
        return $this;
    }
    public function execute()
    {
       $pdo = (Container::DI()['pdo']);
        /** @var \PDOStatement $statement */
       $statement = $pdo->prepare($this->query);
       return $statement->execute();

    }
}