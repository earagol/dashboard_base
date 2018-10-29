<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComunasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComunasTable Test Case
 */
class ComunasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ComunasTable
     */
    public $Comunas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.comunas',
        'app.regions',
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
        $config = TableRegistry::getTableLocator()->exists('Comunas') ? [] : ['className' => ComunasTable::class];
        $this->Comunas = TableRegistry::getTableLocator()->get('Comunas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Comunas);

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
