<?php
use Migrations\AbstractMigration;

class New11122018 extends AbstractMigration
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
        $clientes = $this->table('clientes')
        ->changeColumn('rut', 'string',['null' => false,'limit'=>15,'default'=>null])
        ->save();
    }
}
