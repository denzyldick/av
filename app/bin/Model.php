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
        $this->query = new Query\Builder();
    }

    /**
     * @param array $clause
     * @param null $limit
     * @return Model
     */
    public static function find(array $clause = null,$limit = null)
    {
        $reflection = new \ReflectionClass(get_called_class());
        $name =        $reflection->getShortName();
        $query = new Builder();
        $resultSet = $query->select()->from($name)->where($clause)->limit($limit)->execute();
       var_dump($resultSet);
    }

    public function save()
    {

    }

    public function delete()
    {

    }




}
