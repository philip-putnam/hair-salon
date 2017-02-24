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

        function setName()
        {
            
        }

    }

?>
