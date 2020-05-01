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
        return $this->getRecordsWithPage($this->tableName, "select b.title, b.content, b.created, a.first_name as author_first_name, a.last_name as author_last_name from blogs b join authors a on a.id = b.author_id", $page, $limit);
    }
}