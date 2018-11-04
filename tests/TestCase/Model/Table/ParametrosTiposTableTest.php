<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParametrosTiposTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParametrosTiposTable Test Case
 */
class ParametrosTiposTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ParametrosTiposTable
     */
    public $ParametrosTipos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.parametros_tipos',
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
        $config = TableRegistry::getTableLocator()->exists('ParametrosTipos') ? [] : ['className' => ParametrosTiposTable::class];
        $this->ParametrosTipos = TableRegistry::getTableLocator()->get('ParametrosTipos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ParametrosTipos);

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
