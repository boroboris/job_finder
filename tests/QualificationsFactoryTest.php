<?php

require_once __DIR__ . '/../Qualifications/QualificationsFactory.php';
require_once __DIR__ . '/../Qualifications/RealEstateQualification.php';
require_once __DIR__ . '/../Qualifications/Qualification.php';
require_once __DIR__ . '/../Qualifications/OtherQualification.php';
require_once __DIR__ . '/../Qualifications/DocumentQualification.php';

use App\Qualifications\QualificationsFactory;
use PHPUnit\Framework\TestCase;

final class QualificationsFactoryTest extends TestCase
{
    public function testShouldCreateRealEstate()
    {
        $realEstateTypes = require __DIR__ . '/../enums/real_estate_types.php';

        $typeNumber = rand(0, count($realEstateTypes) - 1);
        $type = $realEstateTypes[$typeNumber];

        $qualification = QualificationsFactory::createQualification($type);

        $className = get_class($qualification);
        $this->assertEquals('App\Qualifications\RealEstateQualification', $className);
    }

    public function testShouldCreateOtherQualificationType()
    {
        $type = 'my requirement';

        $qualification = QualificationsFactory::createQualification($type);

        $className = get_class($qualification);
        $this->assertEquals('App\Qualifications\OtherQualification', $className);
    }

    public function testShouldCreateDocumentQualificationType()
    {
        $documentTypes = require __DIR__ . '/../enums/document_types.php';

        $typeNumber = rand(0, count($documentTypes) - 1);
        $type = $documentTypes[$typeNumber];

        $qualification = QualificationsFactory::createQualification($type);

        $className = get_class($qualification);
        $this->assertEquals('App\Qualifications\DocumentQualification', $className);
    }

    public function testShouldCreateInsuranceQualificationType()
    {
        $insuranceTypes = require __DIR__ . '/../enums/insurance_types.php';

        $typeNumber = rand(0, count($insuranceTypes) - 1);
        $type = $insuranceTypes[$typeNumber];

        $qualification = QualificationsFactory::createQualification($type);

        $className = get_class($qualification);
        $this->assertEquals('App\Qualifications\InsuranceQualification', $className);
    }

    public function testShouldCreateCarWithNDoors()
    {
        $type = '4 door car';

        $qualification = QualificationsFactory::createQualification($type);

        $className = get_class($qualification);
        $this->assertEquals('App\Qualifications\VehicleQualification', $className);
        $this->assertEquals(4, $qualification->getNumberOfDoors());

        $type = '9 door car';

        $qualification = QualificationsFactory::createQualification($type);

        $className = get_class($qualification);
        $this->assertEquals('App\Qualifications\VehicleQualification', $className);
        $this->assertEquals(9, $qualification->getNumberOfDoors());
    }

    public function testShouldCreateBikeWith0Doors()
    {
        $type = 'bike';

        $qualification = QualificationsFactory::createQualification($type);

        $className = get_class($qualification);
        $this->assertEquals('App\Qualifications\VehicleQualification', $className);
        $this->assertEquals(0, $qualification->getNumberOfDoors());
    }
}