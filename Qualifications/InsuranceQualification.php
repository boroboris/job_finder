<?php
namespace App\Qualifications;


class InsuranceQualification implements Qualification
{
    private $name;
    private $type;

    public function __construct($type, $name)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

}