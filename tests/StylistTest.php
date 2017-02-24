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
            $stylist1 = "Debra Collins";
            $stylist2 = "George Peterson";
            $stylist3 = "Jose Martinez";
            $id1 = 1;
            $id2 = 2;
            $id3 = 3;
            $GLOBALS['DB']->exec("INSERT INTO stylists (name, id) VALUES ('{$stylist1}', {$id1});");
            $GLOBALS['DB']->exec("INSERT INTO stylists (name, id) VALUES ('{$stylist2}', {$id2});");
            $GLOBALS['DB']->exec("INSERT INTO stylists (name, id) VALUES ('{$stylist3}', {$id3});");

            $debra = new Stylist($stylist1, $id1);
            $george = new Stylist($stylist2, $id2);
            $jose = new Stylist($stylist3, $id3);

            //Act
            $result = array();
            array_push($result, $debra);
            array_push($result, $george);
            array_push($result, $jose);
            $found_stylists = Stylist::getAll();

            //Assert
            $this->assertEquals($found_stylists, $result);
        }
    }
?>
