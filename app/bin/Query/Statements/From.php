<?php
/**
 * Created by PhpStorm.
 * User: denzyl
 * Date: 20-7-15
 * Time: 21:05
 */

namespace Framework\Library\Query\Statements;


class From
{
    private $query;

    public function __construct($table)
    {
            $table = strtolower($table);
            $this->query .= "FROM {$table}";

    }

    public function __toString()
    {
        return $this->query;
    }
}