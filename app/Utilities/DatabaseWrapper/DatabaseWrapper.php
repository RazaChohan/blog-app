<?php
namespace App\Utilities\DatabaseWrapper;

use App\Utilities\Environment\EnvironmentSetting;
use PDO;
use Exception;
use PDOException;

class DatabaseWrapper {
    /***
     * Environment settings object
     *
     * @var
     */
    private $environmentSettingsObject;
    /***
     * Connection
     *
     * @var array
     */
    private $connection;

    /***
     * Contructor
     *
     * DatabaseWrapper constructor.
     */
    public function __construct()
    {
        $this->connection = null;
        $this->environmentSettingsObject = new EnvironmentSetting();
    }
    /***
     * Executes a select query and returns dataset
     *
     * @param $query
     * @param null $dataset
     *
     * @return
     *
     * @throws
     */
    public function executeSelect($query) {
        return $this->BaseQueryExecutor("S", $query);
    }
    /***
     * Get connection
     *
     * @return mixed|null|PDO
     * @throws Exception
     */
    private function getConnection()
    {
        // Establish connection
        $dBSetting = null;
        $connection = null;
        try {
            if(is_null($this->connection)) {
                $dBSetting = $this->environmentSettingsObject->getDatabaseSettings();
                $this->connection = new PDO($dBSetting->CONNECTION_STRING, $dBSetting->USER_NAME, $dBSetting->PASSWORD, [PDO::ATTR_PERSISTENT => true]);
            }
        } catch (PDOException $e) {
            throw new Exception("Connect failed: " .  $e->getMessage());
        }
        return $this->connection;
    }

    /***
     * Base query executor
     *
     * @param $type
     * @param $query
     * @param null $params
     * @return array|bool
     * @throws Exception
     */
    private function baseQueryExecutor($type, $query, $params = null)
    {
        $dataset = null;
        //Get pdo connection
        $pdo = $this->getConnection();
        // Run query based on the type of request
        switch ($type) {
            //Select
            case "S":
                // Execute and evaluate query
                if ($result = $pdo->query($query)) {
                    // Check row count
                    if ($result->rowCount() == 0) {
                        // Set to null
                        $dataset = null;
                    } else {
                        // Set object
                        while ($row = $result->fetchObject()) {
                            // Add to dataset
                            $dataset[] = $row;
                        }
                    }
                } else {
                    // Throw exception
                    throw new Exception(print_r($pdo->errorInfo(), true));
                }
                break;
        }
        return $dataset;
    }


}