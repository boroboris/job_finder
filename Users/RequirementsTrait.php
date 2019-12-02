<?php
namespace App\Users;

require_once __DIR__ . '/../Qualifications/QualificationsFactory.php';

use App\Qualifications\QualificationsFactory;

trait RequirementsTrait
{
    public function groupRequirementsByName(array $requirements, &$propertyToUpdate): void
    {
        foreach ($requirements as $requirement) {
            $qualifications = [];
            foreach ($requirement as $qualificationsList) {
                $qualification = QualificationsFactory::createQualification($qualificationsList);

                $qualifications[] = $qualification;
            }

            $name = $qualifications[0]->getName();
            $propertyToUpdate[$name] = $qualifications;
        }
    }
}