<?php declare(strict_types=1);

namespace App\Doctrine\Factory;

use Doctrine\DBAL\Driver\PDOMySql\Driver;
use PDO;

final class Connection extends PDO\MySQL\Driver
{
    public function connect(array $params = null, $username = null, $password = null, array $driverOptions = [])
    {
        //getting PDO connection from other framework, CMS etc.
        return new PDO('mysql:host=localhost;dbname=example', 'root', 'qwer', [
            PDO::ATTR_PERSISTENT => true
        ]);
    }
}