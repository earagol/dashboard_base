<?php
use Migrations\AbstractMigration;

class Nueva1811 extends AbstractMigration
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
        $tableventas = $this->table('ventas')
        ->addColumn('monto_transferencia_cartera', 'float', [
            'default' => null,
            'null' => true,
            'after' => 'monto_cartera',
        ])
        ->addColumn('confirma_transferencia_cartera', 'boolean', [
            'default' => null,
            'null' => true,
            'after' => 'monto_cartera',
        ])
        ->addColumn('monto_efectivo_cartera', 'float', [
            'default' => null,
            'null' => true,
            'after' => 'monto_cartera',
        ])
        ->addColumn('visita_id', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'fecha',
        ])
        ->update();


        $tableVisitas = $this->table('visitas')
        ->addColumn('monto_transferencia', 'float', [
            'default' => null,
            'null' => true,
            'after' => 'status'
        ])
        ->addColumn('transferencia', 'boolean', [
            'default' => 0,
            'null' => false,
            'after' => 'status'
        ])
        ->addColumn('monto_efectivo', 'float', [
            'default' => null,
            'null' => true,
            'after' => 'status'
        ])
        ->addColumn('efectivo', 'boolean', [
            'default' => 0,
            'null' => false,
            'after' => 'status'
        ])
         ->addColumn('monto_total', 'float', [
            'default' => null,
            'null' => false,
            'after' => 'status'
        ])
        ->addColumn('tiene_detalles', 'boolean', [
            'default' => 0,
            'null' => false,
            'after' => 'status'
        ])
        ->update();


        $tableVisitaVentas = $this->table('visita_detalles')
        ->addColumn('visita_id', 'integer', [
            'default' => null,
            'null' => false
        ])
        ->addColumn('producto_id', 'integer', [
            'default' => null,
            'null' => false
        ])
        ->addColumn('precio_id', 'integer', [
            'default' => null,
            'null' => false
        ])
        ->addColumn('precio_unitario', 'float', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('cantidad', 'integer', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('total', 'float', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ])
        ->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
        ])
        ->create();   
    }
}
