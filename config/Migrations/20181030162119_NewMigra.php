<?php
use Migrations\AbstractMigration;

class NewMigra extends AbstractMigration
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
        $visitas = $this->table('visitas')
        ->changeColumn('fecha_vencimiento', 'date')
        ->save();
    }
}
