<?php
namespace App\Qualifications;

require_once __DIR__ . '/Qualification.php';

class RealEstateQualification implements Qualification
{
    private $type;
    private $name;

    public function __construct($type, $name)
    {
        $this->type = $type;
        $this->name = $name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getName()
    {
        return $this->name;
    }
}