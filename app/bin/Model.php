<?php

namespace Av\Library;

use Av\Library\Query\ResultSet;
use Av\Library\Query\Set;
use Av\Library\Query\Builder;
use ReflectionClass;

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
    public static function find(array $options = null)
    {
        $reflection = new ReflectionClass(get_called_class());
        $builder = new Builder($reflection);

        /***
         * Extract where clause from options
         */
        $limit = $options['limit'];
        $order = $options['order'];
        $group = $options['group'];
        $having = $options['having'];
        unset($options['limit']);
        unset($options['order']);
        unset($options['group']);
        unset($options['having']);
        $where = $options;
        return $builder->select()->from()->where($where)->limit($limit)->order($order)->group($group)->having($having)->execute();
    }

    public function save()
    {

    }

    public function delete()
    {

    }


}
