<?php

namespace Framework\Library\Query;


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
    {   $this->query = new Select();

        return $this;
    }

    /**
     * @param array $from
     * @return $this
     * @internal param $name
     */
    public function from($from)
    {
       $this->query = new From($from);

        return $this;
    }

    /**
     * @param $clause
     * @return $this
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
        return $this->query;
    }
}