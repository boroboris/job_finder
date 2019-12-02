<?php

require_once __DIR__ . '/../Users/Advertisement.php';

use App\Users\Advertisement;
use PHPUnit\Framework\TestCase;

class AdvertisementTest extends TestCase
{
    public function testShouldCreateInsuranceAdvertisement()
    {
        $requirements = [
            ["property insurance"]
        ];

        $advertisement = new Advertisement('Company Test', $requirements);

        $keys = array_keys($advertisement->getRequiredQualifications());
        $this->assertEquals('insurance', $keys[0]);
    }

    public function testShouldCreateJobAdvertisement()
    {
        $requirements = [
            ["5 door car","4 door car"],
            ["driver's license"],
            ["car insurance"]
        ];

        $advertisement = new Advertisement('Company Test', $requirements);

        $keys = array_keys($advertisement->getRequiredQualifications());
        $this->assertEquals('vehicle', $keys[0]);
        $this->assertEquals('document', $keys[1]);
        $this->assertEquals('insurance', $keys[2]);
    }
}