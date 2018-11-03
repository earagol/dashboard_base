<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ControlDeudaPagosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ControlDeudaPagosTable Test Case
 */
class ControlDeudaPagosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ControlDeudaPagosTable
     */
    public $ControlDeudaPagos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.control_deuda_pagos',
        'app.clientes',
        'app.usuarios',
        'app.ventas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ControlDeudaPagos') ? [] : ['className' => ControlDeudaPagosTable::class];
        $this->ControlDeudaPagos = TableRegistry::getTableLocator()->get('ControlDeudaPagos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ControlDeudaPagos);

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
