<?php
/**
 * Created by PhpStorm.
 * User: denzyl
 * Date: 20-7-15
 * Time: 21:12
 */

namespace Framework\Library\Query\Statements;


class Limit
{
    private $query;
    private $statement = "LIMIT";
    public function __construct($start,$end)
    {
        if(is_int($end) && is_int($start))
        {
            $this->query = "{$this->statement} {$start}, {$end}";
        }else{
            $this->query = "{$this->statement} {$start}";
        }

    }
    public function __toString()
    {
        return $this->query;
    }
}