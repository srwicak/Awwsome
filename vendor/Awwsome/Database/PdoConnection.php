<?php

namespace Awwsome\Database;

use Awwsome\Core\Config;
use PDO;

class PdoConnection
{
    private $connection;

    public function __construct()
    {
        $this->config = new Config();
        $this->config = $this->config->configCaching("database");
    }

    private function connection()
    {
        if (!extension_loaded('PDO')) {
            throw new ExceptionHandler('PDO extenstion not installed!');
        }

        if ('AWWSOME_MODE' === 1)
            $options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

        $options[PDO::ATTR_PERSISTENT] = $this->config['persistent'];

        $dsn = $this->config['driver'] . ":host=" .
            $this->config['host'] . ";port=" .
            $this->config['port'] . ";dbname=" .
            $this->config['database'] . ";charset=" .
            $this->config['charset'];

        try {
            return new PDO(
                $dsn,
                $this->config['user'],
                $this->config['password'],
                $options
            );
        } catch (PODException $e) {
            print "Error!: " . $e->getMessage() . "<br>";
        }
    }

    public function connect()
    {
        if (is_null($this->connection))
            $this->connection = $this->connection();
    }

    public function close()
    {
        $this->connection = null;
    }

    public function begin()
    {
        $this->connection->beginTransaction();
    }

    public function commit()
    {
        $this->connection->commit();
    }

    public function rollBack()
    {
        $this->connection->collBack();
    }
}