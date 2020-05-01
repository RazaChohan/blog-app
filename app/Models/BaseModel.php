<?php

namespace App\Models;

use App\Utilities\DatabaseWrapper\DatabaseWrapper;

class BaseModel
{
    private $databaseWrapper;
    /***
     * Constructor of base model
     *
     * BaseModel constructor.
     */
    public function __construct()
    {
        $this->databaseWrapper = new DatabaseWrapper();
    }

    /***
     * Get records of specific page
     *
     * @param $query
     * @param $tableName
     * @param null $page
     * @param $limit
     * @return array|null|bool
     *
     */
    protected function getRecordsWithPage($tableName, $query = null, $page = null, $limit = null)
    {
        $offset = null;
        if(!is_null($page) && !is_null($limit)) {
            $offset = ($page - 1) * $limit;
        }
        $query = is_null($query) ? "select * from $tableName" : $query;
        $query .= is_null($limit) ? '' : " limit $limit";
        $query .= is_null($offset) ? '' : " offset $offset";
        return $this->databaseWrapper->executeSelect($query);
    }
}