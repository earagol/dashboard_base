<?php
use Migrations\AbstractMigration;

class New04122018 extends AbstractMigration
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
         $tableproductos = $this->table('parametros_valores_padre')
                            ->addColumn('cierre_id', 'integer', [
                                'default' => null,
                                'null' => true,
                                'after' => 'observacion',
                            ])
                            ->update();
    }
}
