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
    private static $query;

    /**
     * @param array $clause
     * @param null $limit
     * @return Model
     */
    public static function find(array $clause = null,$limit = null)
    {
        $reflection = new \ReflectionClass(get_called_class());
        $builder = new Builder($reflection);
        return $builder->select()->from()->where($clause)->limit($limit)->execute();
    }

    public function save()
    {

    }

    public function delete()
    {

    }




}
