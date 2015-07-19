<?php

namespace Framework\Library;


use Framework\Library\Query\ResultSet;
use Framework\Library\Query\Set;

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
        $reflection = new \ReflectionClass(self);


        $query = new Query\Builder();
        $resultSet = $query->select()->from($reflection->getName())->where($clause)->limit($limit);

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
