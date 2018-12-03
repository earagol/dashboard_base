<?php
use Migrations\AbstractMigration;

class Productos03122018 extends AbstractMigration
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
        $tableproductos = $this->table('productos')
                            ->addColumn('retorna_embase', 'boolean', [
                                'default' => null,
                                'null' => true,
                                'after' => 'descripcion',
                            ])
                            ->update();

        $tableRetornos = $this->table('embases_retornados')
                            ->addColumn('producto_id', 'integer', [
                                'default' => null,
                                'null' => false,
                            ])
                            ->addColumn('cliente_id', 'integer', [
                                'default' => null,
                                'null' => false,
                            ])
                            ->addColumn('venta_id', 'integer', [
                                'default' => null,
                                'null' => true,
                            ])
                            ->addColumn('cantidad', 'integer', [
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

        $tableventas = $this->table('ventas')
                            ->addColumn('tiene_retorno', 'boolean', [
                                'default' => null,
                                'null' => true,
                                'after' => 'tiene_detalles',
                            ])
                            ->update();

        $tableCierre = $this->table('cierre_operaciones')
                            ->addColumn('vendedor_id', 'integer', [
                                'default' => null,
                                'null' => false,
                            ])
                            ->addColumn('admin_id', 'integer', [
                                'default' => null,
                                'null' => false,
                            ])
                            ->addColumn('fecha_cierre', 'date', [
                                'default' => null,
                                'null' => true,
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


