<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParametrosVariosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParametrosVariosTable Test Case
 */
class ParametrosVariosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ParametrosVariosTable
     */
    public $ParametrosVarios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.parametros_varios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ParametrosVarios') ? [] : ['className' => ParametrosVariosTable::class];
        $this->ParametrosVarios = TableRegistry::getTableLocator()->get('ParametrosVarios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ParametrosVarios);

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
