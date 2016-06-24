<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProdisTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProdisTable Test Case
 */
class ProdisTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProdisTable
     */
    public $Prodis;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.prodis',
        'app.students'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Prodis') ? [] : ['className' => 'App\Model\Table\ProdisTable'];
        $this->Prodis = TableRegistry::get('Prodis', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Prodis);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
