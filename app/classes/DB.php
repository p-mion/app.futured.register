<?php


/**
 * Class DB
 */
class DB
{

    /**
     * @var
     */
    public static $_instance;
    /**
     * @var
     */
    protected $conn;

    /**
     * @return \DB
     */
    public static function instance()
    {
        if (self::$_instance === null) {

            $class_name = static::class;
            self::$_instance = new $class_name();
        }

        return self::$_instance;
    }

    public function getRecords($query, $params = [], $base = null)
    {

        $result = null;
        $stmt = $this->conn()->query($query);
        if ($stmt) {
            foreach ($params as $attr => $value) {

                $stmt->bindParam($attr, $value);
            }

            if ($stmt->execute()) {
                if (is_object($base)) {

                    $result = $stmt->fetchAll(PDO::FETCH_CLASS, $base);
                } else {

                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }

            }
        }
        return $result;
    }

    /**
     * @return \PDO;
     */
    public function conn()
    {

        if ($this->conn === null) {

            $this->conn = new PDO(sprintf(
                'mysql:host=%s;dbname=%s',
                env('default_host'),
                env('default_database')),
                env('default_user'),
                env('default_password')
            );

            if (!$this->conn) {

                throw new \PDOException("connect to db failed");
            }
        }

        return $this->conn;
    }
}
