<?php
namespace App\Qualifications;

require_once __DIR__ . '/Qualification.php';

class VehicleQualification implements Qualification
{
    private $type;
    private $name;
    private $numberOfDoors;

    public function __construct($type, $name, $numberOfDoors)
    {
        $this->type = $type;
        $this->name = $name;
        $this->numberOfDoors = $numberOfDoors;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNumberOfDoors()
    {
        return $this->numberOfDoors;
    }
}