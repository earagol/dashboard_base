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
    }
}
