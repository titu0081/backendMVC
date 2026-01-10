<?PHP
class DBConection
{

    private static $mysqli;
    private static $init = false;

    public static function iniConnectionDb()
    {
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "Residentevil5_??";
        $db_name = "seriesDB";

        $mysqli = @new mysqli(
            $db_host,
            $db_user,
            $db_password,
            $db_name
        );

        if ($mysqli->connect_error) {
            die('Error: ' . $mysqli->connect_error);
        }

        self::$mysqli = $mysqli;
        self::$init = true;

        return $mysqli;
    }

    public static function getConection()
    {
        if (self::$init) {
            return self::$mysqli;
        } else {
            return self::iniConnectionDb();
        }
    }
}
