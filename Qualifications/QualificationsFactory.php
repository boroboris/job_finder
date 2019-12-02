<?php
namespace App\Qualifications;

require_once __DIR__ . '/../Qualifications/RealEstateQualification.php';
require_once __DIR__ . '/../Qualifications/OtherQualification.php';
require_once __DIR__ . '/../Qualifications/DocumentQualification.php';
require_once __DIR__ . '/../Qualifications/InsuranceQualification.php';
require_once __DIR__ . '/../Qualifications/VehicleQualification.php';

class QualificationsFactory
{
    public static function createQualification($type)
    {
        $realEstateTypes = require __DIR__ . '/../enums/real_estate_types.php';
        $documentTypes = require __DIR__ . '/../enums/document_types.php';
        $insuranceTypes = require __DIR__ . '/../enums/insurance_types.php';
        $vehicleTypes = require __DIR__ . '/../enums/vehicle_types.php';

        switch ($type) {
            case array_search($type, $realEstateTypes) !== false:
                return new RealEstateQualification($type, 'real estate');
            case array_search($type, $documentTypes) !== false:
                return new DocumentQualification($type, 'document');
            case array_search($type, $insuranceTypes) !== false:
                return new InsuranceQualification($type, 'insurance');
            case self::isVehicle($type, $vehicleTypes):
                $n = 0;
                $matches = [];

                if(preg_match_all('/(\d+) door car/', $type, $matches)) {
                    $n = $matches[1][0];
                }

                return new VehicleQualification($type, 'vehicle', $n);
            default:
                return new OtherQualification($type, 'other');
        }
    }

    private static function isVehicle($type, $vehicleTypes)
    {
        $replacedType = preg_replace('/\d door car/', 'n door car', $type);

        return (array_search($replacedType, $vehicleTypes) !== false);
    }
}