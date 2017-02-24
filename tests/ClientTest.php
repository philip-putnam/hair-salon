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
        protected function tearDown()
        {
            Stylist::deleteAll();
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

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

        function test_getStylistId()
        {
            //Arrange
            $stylist = new Stylist("Debra Collins");
            $stylist->save();

            $client = new Client("George Clooney", $stylist->getId());
            $new_name = "George S Cloonae";

            //Act
            $result = $stylist->getId();
            $client_stylist_id = $client->getStylistId();

            //Assert
            $this->assertEquals($client_stylist_id, $result);
        }

        function test_setStylistId()
        {
            //Arrange
            $debra = new Stylist("Debra Collins");
            $debra->save();
            $george = new Stylist("George Peterson");
            $george->save();

            $client = new Client("George Clooney", $debra->getId());
            $new_name = "George S Cloonae";

            //Act
            $result = $george->getId();
            $client->setStylistId($george->getId());
            $client_stylist_id = $client->getStylistId();

            //Assert
            $this->assertEquals($client_stylist_id, $result);
        }

        function test_getId()
        {
            //Arrange
            $stylist = new Stylist("Debra Collins");
            $stylist->save();

            $id = 4;
            $client = new Client("George Clooney", $stylist->getId(), $id);
            $new_name = "George S Cloonae";

            //Act
            $result = $id;
            $client_stylist_id = $client->getId();

            //Assert
            $this->assertEquals($client_stylist_id, $result);
        }

        function test_getAll()
        {
            //Arrange
            $debra = new Stylist("Debra Collins");
            $debra->save();

            $name1 = "George Clooney";
            $name2 = "Gwen Stefani";

            $stylist_id = $debra->getId();

            $id1 = 13;
            $id2 = 25;

            $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id, id) VALUES ('{$name1}', {$stylist_id}, {$id1});");
            $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id, id) VALUES ('{$name2}', {$stylist_id}, {$id2});");

            //Act
            $george = new Client($name1, $stylist_id, $id1);
            $gwen = new Client($name2, $stylist_id, $id2);
            $result = array();
            array_push($result, $george);
            array_push($result, $gwen);
            $found_clients = Client::getAll();

            //Assert
            $this->assertEquals($found_clients, $result);
        }

        function test_save()
        {
          //Arrange
          $stylist = new Stylist("Debra Collins");
          $stylist->save();

          $george = new Client("George Clooney", $stylist->getId());
          $george->save();
          $gwen = new Client("Gwen Stefani", $stylist->getId());
          $gwen->save();

          //Act
          $result = Client::getAll();

          //Assert
          $this->assertEquals([$george, $gwen], $result);
        }

        function test_deleteAll()
        {
          //Arrange
          $stylist = new Stylist("Debra Collins");
          $stylist->save();

          $george = new Client("George Clooney", $stylist->getId());
          $george->save();
          $gwen = new Client("Gwen Stefani", $stylist->getId());
          $gwen->save();

          //Act
          Client::deleteAll();
          $result = Client::getAll();

          //Assert
          $this->assertEquals([], $result);
        }

        function test_find()
        {
          //Arrange
          $stylist = new Stylist("Debra Collins");
          $stylist->save();

          $george = new Client("George Clooney", $stylist->getId());
          $george->save();
          $gwen = new Client("Gwen Stefani", $stylist->getId());
          $gwen->save();

          //Act
          $result = $george;
          $found_client = Client::find($george->getId());

          //Assert
          $this->assertEquals($found_client, [$george]);
        }

    }

?>
