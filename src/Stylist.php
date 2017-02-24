<<?php
    class Stylist
    {
        private $name;
        private $id;

        function __construct($name, $id = NULL)
        {
            $this->name = (string) $name;
            $this->id = (int) $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function find($stylist_id)
        {
            $found_stylist = $GLOBALS['DB']->query("SELECT * FROM stylists WHERE id = {$stylist_id};");
            $stylists = array();
            foreach($found_stylist as $stylist)
            {
                $name = $stylist['name'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($name, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function findStylistsClients($stylist_id)
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$stylist_id};");
            $clients = array();
            foreach($returned_clients as $client)
            {
                $name = $client['name'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client($name, $stylist_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach($returned_stylists as $stylist)
            {
                $name = $stylist['name'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($name, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function update($stylist_id, $new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = $stylist_id;");
        }

        static function deleteStylist($stylist_id)
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$stylist_id};");
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists;");
        }
    }

?>
