<?php

namespace App\Utilities\Environment;

use stdClass;
/***
 * Environment settings
 *
 * Class EnvironmentSetting
 */
class EnvironmentSetting
{
    /***
     * Get all environment variables
     *
     * @return mixed
     */
    public function getAllEnvironmentVariables()
    {
        return include $_SERVER['DOCUMENT_ROOT'] . '/env.php';
    }

    /***
     * Get database settings
     *
     * @return stdClass
     */
    public function getDatabaseSettings()
    {
        $settings               = $this->getAllEnvironmentVariables();
        $dbSettings             = $settings['DB'];
        $settingObj             = new stdClass();
        $settingObj->USER_NAME  = $dbSettings['USER_NAME'];
        $settingObj->PASSWORD   = $dbSettings['PASSWORD'];
        $settingObj->CONNECTION_STRING = "mysql:host=" . $dbSettings['HOST'] . ";dbname=" . $dbSettings['NAME']. ";charset=utf8";
        return $settingObj;
    }
}