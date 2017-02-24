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
            Stylist::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $stylist = new Stylist("Debra Collins");

            //Act
            $result = "Debra Collins";
            $stylist_name = $stylist->getName();

            //Assert
            $this->assertEquals($stylist_name, $result);
        }

        function test_setName()
        {
            //Arrange
            $stylist = new Stylist("Debra Collins");

            //Act
            $stylist->setName("Debora Collins");
            $result = "Debora Collins";
            $new_name = $stylist->getName();

            //Assert
            $this->assertEquals($new_name, $result);
        }

        function test_getId()
        {
            //Arrange
            $id = 4;
            $stylist = new Stylist("Debra Collins", $id);

            //Act
            $result = $id;
            $stylist_id = $stylist->getId();

            //Assert
            $this->assertEquals($stylist_id, $result);
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

        function test_save()
        {
            //Arrange
            $debra = new Stylist("Debra Collins");
            $debra->save();
            $george = new Stylist("George Peterson");
            $george->save();
            $jorge = new Stylist("Jose Martinez");
            $jorge->save();
            $jen = new Stylist("Jen Doe");
            $jen->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$debra, $george, $jorge, $jen], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $debra = new Stylist("Debra Collins");
            $debra->save();
            $george = new Stylist("George Peterson");
            $george->save();
            $jorge = new Stylist("Jose Martinez");
            $jorge->save();
            $jen = new Stylist("Jen Doe");
            $jen->save();

            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $debra = new Stylist("Debra Collins");
            $debra->save();
            $george = new Stylist("George Peterson");
            $george->save();

            //Act
            $found_stylist = Stylist::find($debra->getId());

            //Assert
            $this->assertEquals($found_stylist[0], $debra);
        }
    }
?>
