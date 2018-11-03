<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VentasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VentasTable Test Case
 */
class VentasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VentasTable
     */
    public $Ventas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ventas',
        'app.clientes',
        'app.usuarios',
        'app.venta_detalles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Ventas') ? [] : ['className' => VentasTable::class];
        $this->Ventas = TableRegistry::getTableLocator()->get('Ventas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ventas);

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
