<?php
    class Client
    {
        private $name;
        private $stylist_id;
        private $id;

        function __construct($name, $stylist_id, $id = NULL)
        {
            $this->name = (string) $name;
            $this->stylist_id = (int) $stylist_id;
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

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function setStylistId($new_stylist_id)
        {
            $this->stylist_id = $new_stylist_id;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
          $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylistId()});");
          $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

        static function find($client_id)
        {
          $found_client = $GLOBALS['DB']->query("SELECT * FROM clients WHERE id = {$client_id};");
          $clients = array();
          foreach($found_client as $client)
          {
              $name = $client['name'];
              $stylist_id = $client['stylist_id'];
              $id = $client['id'];
              $new_client = new Client($name, $stylist_id, $id);
              array_push($clients, $new_client);
          }
          return $clients;
        }

        static function deleteClient($client_id)
        {
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$client_id};");
        }

    }

?>
