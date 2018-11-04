<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParametrosValoresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParametrosValoresTable Test Case
 */
class ParametrosValoresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ParametrosValoresTable
     */
    public $ParametrosValores;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.parametros_valores',
        'app.parametro_tipos',
        'app.productos',
        'app.usuarios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ParametrosValores') ? [] : ['className' => ParametrosValoresTable::class];
        $this->ParametrosValores = TableRegistry::getTableLocator()->get('ParametrosValores', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ParametrosValores);

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
