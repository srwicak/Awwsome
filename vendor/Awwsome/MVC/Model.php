<?php

namespace Awwsome\MVC;

use Awwsome\Database\PdoConnection;

class Model
{
    Private $result;
    Private $tableName;

    public function __construct()
    {
        $database = new PdoConnection();
        $database->connect();
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }


}
