<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VisitaDetallesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VisitaDetallesTable Test Case
 */
class VisitaDetallesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VisitaDetallesTable
     */
    public $VisitaDetalles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.visita_detalles',
        'app.visitas',
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
        $config = TableRegistry::getTableLocator()->exists('VisitaDetalles') ? [] : ['className' => VisitaDetallesTable::class];
        $this->VisitaDetalles = TableRegistry::getTableLocator()->get('VisitaDetalles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VisitaDetalles);

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
