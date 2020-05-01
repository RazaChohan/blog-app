<?php

namespace App\Models;
/***
 * Model for user table
 *
 * Class User
 */
class User extends BaseModel
{
    /***
     * Table name
     *
     * @var string
     */
    public $tableName = 'users';

    /***
     * Get blogs
     *
     * @param $username
     * @param $password
     * @return array|bool|null
     */
    public function getUser($username, $password)
    {
        $password = getHashedValue($password);
        return $this->getRecordsWithPage($this->tableName, "select * from users where username = '$username' and password = '$password'");
    }
}