<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClasificacionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClasificacionesTable Test Case
 */
class ClasificacionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClasificacionesTable
     */
    public $Clasificaciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.clasificaciones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Clasificaciones') ? [] : ['className' => ClasificacionesTable::class];
        $this->Clasificaciones = TableRegistry::getTableLocator()->get('Clasificaciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Clasificaciones);

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
