<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RutasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RutasTable Test Case
 */
class RutasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RutasTable
     */
    public $Rutas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rutas',
        'app.usuarios',
        'app.clientes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Rutas') ? [] : ['className' => RutasTable::class];
        $this->Rutas = TableRegistry::getTableLocator()->get('Rutas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Rutas);

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
