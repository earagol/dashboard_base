<?php
use Migrations\AbstractMigration;

class Viernes09112 extends AbstractMigration
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
        $ventas = $this->table('ventas')
        ->changeColumn('monto_total', 'float',['null' => true,'default'=>null])
        ->save();
    }
}
