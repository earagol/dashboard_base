<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;

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
        ->addColumn('user_id', 'integer', [
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

    public function up()
    {
        // inserting only one row
        $hasher = new \Cake\Auth\DefaultPasswordHasher();
        // $singleRow[] = [
        //         'username'      => 'admin',
        //         'password'      => $hasher->hash('1234'),
        //         'email'         => 'admin@gmail.com',
        //         'nombres'       => 'Administrador',
        //         'apellidos'     => 'Del Sistema',
        //         'activo'        => 1,
        //         'role'     => 'admin',
        //         'created'       => date('Y-m-d H:i:s'),
        //     ];

        // $user = $this->table('usuarios');
        // $user->insert($singleRow);
        // $user->save();

        $UsersTable = TableRegistry::get('Usuarios');
        $user = $UsersTable->newEntity();

        $password = $hasher->hash('1234');
        $creacion = date('Y-m-d H:i:s');

        $user->username = 'admin';
        $user->password = $password;
        $user->nombres = 'Administrador';
        $user->apellidos = 'Del Sistema';
        $user->email = 'admin@gmail.com';
        $user->activo = 1;
        $user->role = 'admin';
        $user->created = $creacion;

        $UsersTable->save($user);

        

        // $insert = "INSERT INTO usuarios
        //                         (
        //                         `username`,
        //                         `password`,
        //                         `nombres`,
        //                         `apellidos`,
        //                         `email`,
        //                         `activo`,
        //                         `role`,
        //                         `created`)
        //                         VALUES
        //                         (
        //                         'admin',
        //                         $password,
        //                         'Administrador',
        //                         'Del Sistema',
        //                         'admin@gmail.com',
        //                         1,
        //                         'admin',
        //                         $creacion;";
        // $this->execute($insert);

    }


}
