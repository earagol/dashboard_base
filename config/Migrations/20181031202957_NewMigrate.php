<?php
use Migrations\AbstractMigration;

class NewMigrate extends AbstractMigration
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

        $tableParametros = $this->table('parametros_varios')
        ->addColumn('dias_vencer_visita', 'integer', [
            'default' => null,
            'null' => false,
        ])
        ->create();

    }
}
