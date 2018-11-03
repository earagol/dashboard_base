<?php
use Migrations\AbstractMigration;

class ControlPago extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $tableControls = $this->table('control_deuda_pagos')
        ->addColumn('venta_id', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'usuario_id',
        ])
        ->update();
    }
}
