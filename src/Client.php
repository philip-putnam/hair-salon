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

        static function getAll()
        {

        }
    }

?>
