<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CierreOperacionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CierreOperacionesTable Test Case
 */
class CierreOperacionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CierreOperacionesTable
     */
    public $CierreOperaciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cierre_operaciones',
        'app.vendedors',
        'app.admins'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CierreOperaciones') ? [] : ['className' => CierreOperacionesTable::class];
        $this->CierreOperaciones = TableRegistry::getTableLocator()->get('CierreOperaciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CierreOperaciones);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
