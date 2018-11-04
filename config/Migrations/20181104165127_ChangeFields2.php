<?php
use Migrations\AbstractMigration;

class ChangeFields2 extends AbstractMigration
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
        $tableTipos = $this->table('parametros_valores');
        $tableTipos->renameColumn('tipo_id', 'parametros_tipo_id')
           ->update();

        $tablevalores = $this->table('parametros_valores')
        ->addColumn('usuario_id', 'integer', [
            'default' => null,
            'null' => false,
            'after' => 'monto_o_cantidad',
        ])
        ->addColumn('tipo', 'string', [
            'default' => null,
            'null' => false,
            'limit' => 20,
            'after' => 'usuario_id',
        ])
        ->addColumn('fecha', 'date', [
            'default' => null,
            'null' => false,
            'after' => 'usuario_id',
        ])
        ->addColumn('padre_id', 'integer', [
            'default' => null,
            'null' => false,
            'after' => 'usuario_id',
        ])
        ->update();

        $tablePadre = $this->table('parametros_valores_padre')
        ->addColumn('parametros_tipo_id', 'integer', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ])
        ->addColumn('fecha', 'date', [
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
