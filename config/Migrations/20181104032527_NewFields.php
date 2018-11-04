<?php
use Migrations\AbstractMigration;

class NewFields extends AbstractMigration
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
         $tableVentas = $this->table('ventas')
        ->addColumn('monto_cartera', 'float', [
            'default' => null,
            'null' => true,
            'after' => 'pago_cartera',
        ])
        ->update();
    }
}
