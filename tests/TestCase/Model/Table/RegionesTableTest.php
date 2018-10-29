<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RegionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RegionesTable Test Case
 */
class RegionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RegionesTable
     */
    public $Regiones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.regiones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Regiones') ? [] : ['className' => RegionesTable::class];
        $this->Regiones = TableRegistry::getTableLocator()->get('Regiones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Regiones);

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
