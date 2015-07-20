<?php

namespace Framework\Library;


use Framework\Library\Query\ResultSet;
use Framework\Library\Query\Set;
use Framework\Library\Query\Builder;

abstract class Model
{
    /** @var  \Pimple/Container  $di */
    protected $di;
    /** @var  Query\Builder $query */
    private $query;

    public function __construct()
    {
        $query = new Query\Builder();
    }

    /**
     * @param array $clause
     * @param null $limit
     * @return Model
     */
    public static function find(array $clause,$limit = null)
    {
        $name = get_called_class();

        $query = new Builder();
        $resultSet = $query->select()->from($name)->where($clause)->limit($limit)->execute();
        echo($resultSet);
        $result = new ResultSet();
        foreach ($resultSet as $key => $set ) {
            $set = new Set();
            $set->$key = $set;
            $result->add($set);
        }
        return $resultSet;

    }

    public function save()
    {

    }

    public function delete()
    {

    }




}
