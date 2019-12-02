<?php
namespace App\Users;

require_once __DIR__ . '/RequirementsTrait.php';

class Advertisement
{
    use RequirementsTrait;

    private $name;
    private $requirements;

    public function __construct($name, array $requirements)
    {
        $this->name = $name;
        $this->requirements = [];

        $this->groupRequirementsByName($requirements, $this->requirements);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRequiredQualifications(): array
    {
        return $this->requirements;
    }
}