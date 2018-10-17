<?php
use Migrations\AbstractMigration;

class MyMigration extends AbstractMigration
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
        $tableUsuarios = $this->table('usuarios')
        ->addColumn('username', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => false,
        ])
        ->addColumn('password', 'string', [
            'default' => null,
            'limit' => 60,
            'null' => false,
        ])
        ->addColumn('nombres', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ])
        ->addColumn('apellidos', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ])
        ->addColumn('email', 'string', [
            'default' => null,
            'limit' => 60,
            'null' => true,
        ])
        ->addColumn('activo', 'boolean', [
            'default' => 1,
            'limit' => 1,
            'null' => false,
        ])
         ->addColumn('role', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => false,
        ])
        ->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->create();



        $tablePersonas = $this->table('personas')
        ->addColumn('nombres', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ])
        ->addColumn('apellidos', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ])
        ->addColumn('activo', 'boolean', [
            'default' => null,
            'limit' => 1,
            'null' => false,
        ])
        ->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->create();
    }
}
