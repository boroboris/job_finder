<?php

use PHPUnit\Framework\TestCase;

class JobSearchTest extends TestCase
{
    public function runApp(string $person)
    {
        $personFilename = __DIR__ . '/test_person.txt';
        file_put_contents($personFilename, $person);

        $appPath = __DIR__ . '/../app.php';
        $jobBoardLocation = __DIR__ . '/test_job_board.txt';

        shell_exec('php ' . $appPath . ' ' . $personFilename . ' ' . $jobBoardLocation);
    }

    public function testScenario1()
    {
        $person =  '"Person A" has a bike and a driver\'s license.';

        $this->runApp($person);

        $config = require __DIR__ . '/../config.php';
        $results = file_get_contents($config['results_location']);

        $containsCompanyJ = strpos($results, 'Company J') !== false;
        $this->assertTrue($containsCompanyJ, 'Should contain Company J');

        $otherCompanies = ["Company A", "Company B", "Company C", "Company D", "Company E", "Company F", "Company G",
            "Company H", "Company I", "Company K"];
        foreach ($otherCompanies as $company) {
            $containsCompany = strpos($results, $company) !== false;
            $this->assertFalse($containsCompany, "shouldn't contain " . $company);
        }
    }

    public function testScenario2()
    {
        $person =  '"Person A" has a bike and a driver\'s license and motorcycle insurance.';

        $this->runApp($person);

        $config = require __DIR__ . '/../config.php';
        $results = file_get_contents($config['results_location']);

        $containsCompanyJ = strpos($results, 'Company J') !== false;
        $containsCompanyF = strpos($results, 'Company F') !== false;

        $this->assertTrue($containsCompanyJ, 'Should contain Company J');
        $this->assertTrue($containsCompanyF, 'Should contain Company F');

        $otherCompanies = ["Company A", "Company B", "Company C", "Company D", "Company E", "Company G",
            "Company H", "Company I", "Company K"];
        foreach ($otherCompanies as $company) {
            $containsCompany = strpos($results, $company) !== false;
            $this->assertFalse($containsCompany, "shouldn't contain " . $company);
        }
    }

    public function testScenario3()
    {
        $person =  '"Person A" has a 4 door car or a bike and a driver\'s license and motorcycle insurance.';

        $this->runApp($person);

        $config = require __DIR__ . '/../config.php';
        $results = file_get_contents($config['results_location']);

        $containsCompanyJ = strpos($results, 'Company J') !== false;
        $containsCompanyE = strpos($results, 'Company E') !== false;
        $containsCompanyF = strpos($results, 'Company F') !== false;

        $this->assertTrue($containsCompanyJ, 'Should contain Company J');
        $this->assertTrue($containsCompanyE, 'Should contain Company E');
        $this->assertTrue($containsCompanyF, 'Should contain Company F');

        $otherCompanies = ["Company A", "Company B", "Company C", "Company D", "Company G",
            "Company H", "Company I", "Company K"];
        foreach ($otherCompanies as $company) {
            $containsCompany = strpos($results, $company) !== false;
            $this->assertFalse($containsCompany, "shouldn't contain " . $company);
        }
    }

    public function testScenario4()
    {
        $person =  '"Person A" has a 4 door car or a bike and a driver\'s license and motorcycle insurance or car insurance.';

        $this->runApp($person);

        $config = require __DIR__ . '/../config.php';
        $results = file_get_contents($config['results_location']);

        $containsCompanyJ = strpos($results, 'Company J') !== false;
        $containsCompanyB = strpos($results, 'Company B') !== false;
        $containsCompanyE = strpos($results, 'Company E') !== false;
        $containsCompanyF = strpos($results, 'Company F') !== false;

        $this->assertTrue($containsCompanyJ, 'Should contain Company J');
        $this->assertTrue($containsCompanyB, 'Should contain Company B');
        $this->assertTrue($containsCompanyE, 'Should contain Company E');
        $this->assertTrue($containsCompanyF, 'Should contain Company F');

        $otherCompanies = ["Company A", "Company C", "Company D", "Company G",
            "Company H", "Company I", "Company K"];
        foreach ($otherCompanies as $company) {
            $containsCompany = strpos($results, $company) !== false;
            $this->assertFalse($containsCompany, "shouldn't contain " . $company);
        }
    }

    public function testScenario5()
    {
        $person =  '"Person A" has no qualifications.';

        $this->runApp($person);

        $config = require __DIR__ . '/../config.php';
        $results = file_get_contents($config['results_location']);

        $containsCompanyJ = strpos($results, 'Company J') !== false;
        $this->assertTrue($containsCompanyJ, 'Should contain Company J');

        $otherCompanies = ["Company A", "Company B", "Company C", "Company D", "Company E", "Company F", "Company G",
            "Company H", "Company I", "Company K"];
        foreach ($otherCompanies as $company) {
            $containsCompany = strpos($results, $company) !== false;
            $this->assertFalse($containsCompany, "shouldn't contain " . $company);
        }
    }

    public function testScenario6()
    {
        $person =  '"Person A" has PayPal account.';

        $this->runApp($person);

        $config = require __DIR__ . '/../config.php';
        $results = file_get_contents($config['results_location']);

        $containsCompanyJ = strpos($results, 'Company J') !== false;
        $containsCompanyK = strpos($results, 'Company K') !== false;

        $this->assertTrue($containsCompanyJ, 'Should contain Company J');
        $this->assertTrue($containsCompanyJ, 'Should contain Company K');

        $otherCompanies = ["Company A", "Company B", "Company C", "Company D", "Company E", "Company F", "Company G",
            "Company H", "Company I"];
        foreach ($otherCompanies as $company) {
            $containsCompany = strpos($results, $company) !== false;
            $this->assertFalse($containsCompany, "shouldn't contain " . $company);
        }
    }

    public function testScenario7()
    {
        $person =  '"Person A" has mobile phone and a suit.';

        $this->runApp($person);

        $config = require __DIR__ . '/../config.php';
        $results = file_get_contents($config['results_location']);

        $containsCompanyJ = strpos($results, 'Company J') !== false;

        $this->assertTrue($containsCompanyJ, 'Should contain Company J');

        $otherCompanies = ["Company A", "Company B", "Company C", "Company D", "Company E", "Company F", "Company G",
            "Company H", "Company I", "Company K"];
        foreach ($otherCompanies as $company) {
            $containsCompany = strpos($results, $company) !== false;
            $this->assertFalse($containsCompany, "shouldn't contain " . $company);
        }
    }
}