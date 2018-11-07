<?php
use Migrations\AbstractMigration;

class Nueva extends AbstractMigration
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
        ->addColumn('confirma_transferencia', 'boolean', [
            'default' => null,
            'null' => true,
            'after' => 'monto_transferencia',
        ])
        ->addColumn('fecha_transferencia', 'date', [
            'default' => null,
            'null' => true,
            'after' => 'confirma_transferencia',
        ])
        ->update();
    }
}
