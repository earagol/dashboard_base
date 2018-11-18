<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VentaDetallesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VentaDetallesTable Test Case
 */
class VentaDetallesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VentaDetallesTable
     */
    public $VentaDetalles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.venta_detalles',
        'app.ventas',
        'app.productos',
        'app.precios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('VentaDetalles') ? [] : ['className' => VentaDetallesTable::class];
        $this->VentaDetalles = TableRegistry::getTableLocator()->get('VentaDetalles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VentaDetalles);

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
