<?php
// 21005729 Saul Maylin
//  22/11/2025
// v1
// Occupants View Class

class Occupants
{
    private $id;
    private $name;
    private $occupants;

    public function __construct($id, $name, $occupants)
    {
        $this->id = $id;
        $this->name = $name;
        $this->occupants = $occupants;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOccupants()
    {
        return $this->occupants;
    }

    public function getID()
    {
        return $this->id;
    }
}

?>