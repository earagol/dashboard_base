<?php
use Migrations\AbstractMigration;

class New2611 extends AbstractMigration
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
        ->addColumn('observacion_anulacion', 'text', [
            'default' => null,
            'null' => true,
            'after' => 'visita_id',
        ])
        ->addColumn('usuario_id_anulacion', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'visita_id',
        ])
        ->update();


        $tableCreditos = $this->table('log_creditos')
        ->addColumn('cliente_id', 'integer', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('monto', 'float', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('usuario_id', 'integer', [
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
