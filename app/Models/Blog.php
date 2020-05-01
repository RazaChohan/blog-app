<?php

namespace App\Models;
/***
 * Model for blog table
 *
 * Class Blog
 */
class Blog extends BaseModel
{
    /***
     * Table name
     *
     * @var string
     */
    public $tableName = 'blogs';

    /***
     * Get blogs
     *
     * @param int $page
     * @param int $limit
     * @return array|bool|null
     */
    public function getBlogs($page = 1, $limit = 3)
    {
        return $this->getRecordsWithPage($this->tableName, null, $page, $limit);
    }
}