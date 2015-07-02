<?php

namespace Framework\Library;


abstract class Model
{
    /** @var DBFunctionality $db */
    protected $db;

    /** @var  \Pimple/Container  $di */
    protected $di;

    public function __construct()
    {

        $this->db = new DBFunctionality();

    }

}
