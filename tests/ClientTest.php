<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Client.php';
    require_once 'src/Stylist.php';

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        function test_getName()
        {
            //Arrange
            $stylist = new Stylist("Debra Collins");
            $stylist->save();

            $client = new Client("George Clooney", $stylist->getId());

            //Act
            $result = "George Clooney";
            $client_name = $client->getName();

            //Assert
            $this->assertEquals($client_name, $result);
        }

        function test_setName()
        {
            //Arrange
            $stylist = new Stylist("Debra Collins");
            $stylist->save();

            $client = new Client("George Clooney", $stylist->getId());
            $new_name = "George S Cloonae";

            //Act
            $result = $new_name;
            $client->setName($new_name);
            $client_name = $client->getName();

            //Assert
            $this->assertEquals($client_name, $result);
        }
    }

?>
