<?php
namespace App\Test\TestCase\Controller;

use Cake\Collection\Collection;
use Cake\ORM\TableRegistry;
use App\Controller\InsurancesController;
use Cake\TestSuite\IntegrationTestCase;

use App\Model\Entity\Insurance;
/**
 * App\Controller\InsurancesController Test Case
 */
class InsurancesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.insurances'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testId()
    {
        $insurances = TableRegistry::get('insurances');
        $insuranceData = $insurances->find()->first();

        $this->configRequest([
            'headers' => [
                'X-API-TOKEN' => '85738f8f9a7f1b04b5329c590ebcb9e425925c6d0984089c43a022de4f19c281'
            ]
        ]);

        $this->get('/api/insurances/id/' . $insuranceData->id);
        $this->assertResponseOk();
        $insurance = $this->viewVariable('insurance');
        $this->assertEquals(json_encode($insuranceData), $insurance);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testId_not_found()
    {
        $this->configRequest([
            'headers' => [
                'X-API-TOKEN' => '85738f8f9a7f1b04b5329c590ebcb9e425925c6d0984089c43a022de4f19c281'
            ]
        ]);

        $this->get('/api/insurances/id/99');
        $this->assertResponseOk();
        $insurance = $this->viewVariable('insurance');
        $this->assertEquals(json_encode(null), $insurance);
    }

    /**
     * Test country method
     *
     * @return void
     */
    public function testCountry()
    {
        $insurances = TableRegistry::get('insurances');
        $insuranceData = $insurances->find()->where([
            'country' => 'Indonesia',
        ])->all();

        $this->configRequest([
            'headers' => [
                'X-API-TOKEN' => '85738f8f9a7f1b04b5329c590ebcb9e425925c6d0984089c43a022de4f19c281'
            ]
        ]);

        $this->get('/api/insurances/country/Indonesia');
        $this->assertResponseOk();
        $insurances = $this->viewVariable('insurances');
        $this->assertEquals(json_encode($insuranceData), $insurances);
    }

    /**
     * Test country method
     *
     * @return void
     */
    public function testCountry_not_found()
    {
        $this->configRequest([
            'headers' => [
                'X-API-TOKEN' => '85738f8f9a7f1b04b5329c590ebcb9e425925c6d0984089c43a022de4f19c281'
            ]
        ]);

        $this->get('/api/insurances/country/Singapore');
        $this->assertResponseOk();
        $insurances = $this->viewVariable('insurances');
        $this->assertEquals(json_encode(null), $insurances);
    }

    /**
     * Test countrySummary method
     *
     * @return void
     */
    public function testCountrySummary()
    {
        $this->configRequest([
            'headers' => [
                'X-API-TOKEN' => '85738f8f9a7f1b04b5329c590ebcb9e425925c6d0984089c43a022de4f19c281'
            ]
        ]);

        $expecteds = [
            'statecode',
            'country',
            'eq_site_limit',
            'hu_site_limit',
            'fl_site_limit',
            'fr_site_limit',
            'tiv_2011',
            'tiv_2012',
            'eq_site_deductible',
            'hu_site_deductible',
            'fl_site_deductible',
            'fr_site_deductible',
            'point_latitude',
            'point_longitude',
        ];

        $this->get('/api/insurances/country_summary/Indonesia');
        $this->assertResponseOk();
        $insurance = $this->viewVariable('insurance');

        foreach ($expecteds as $expected)
            $this->assertArrayHasKey($expected, (array) json_decode($insurance)[0]);
    }

    /**
     * Test countrySummary method
     *
     * @return void
     */
    public function testCountrySummary_not_found()
    {
        $this->configRequest([
            'headers' => [
                'X-API-TOKEN' => '85738f8f9a7f1b04b5329c590ebcb9e425925c6d0984089c43a022de4f19c281'
            ]
        ]);

        $expected = [
            'statecode' => null,
            'country' => null,
            'eq_site_limit' => null,
            'hu_site_limit' => null,
            'fl_site_limit' => null,
            'fr_site_limit' => null,
            'tiv_2011' => null,
            'tiv_2012' => null,
            'eq_site_deductible' => null,
            'hu_site_deductible' => null,
            'fl_site_deductible' => null,
            'fr_site_deductible' => null,
            'point_latitude' => null,
            'point_longitude' => null,
        ];

        $this->get('/api/insurances/country_summary/Singapore');
        $this->assertResponseOk();
        $insurance = $this->viewVariable('insurance');
        $this->assertEquals($expected, (array) json_decode($insurance)[0]);
    }
}
