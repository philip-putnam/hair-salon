<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Stylist.php';
    require_once 'src/Client.php';

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists");
        }

        function test_getAll()
        {
            //Arrange
            $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('Debra Collins');");
            $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('George Peterson');");
            $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('Jose Martinez');");

            //Act
            $result = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $found_stylists = Stylist::getAll();

            //Assert
            $this->assertEquals($found_stylists, $result);
        }
    }
?>
