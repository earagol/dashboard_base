<?php
use Migrations\AbstractSeed;
use Cake\ORM\TableRegistry;

/**
 * Usuarios seed.
 */
class UsuariosSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $hasher = new \Cake\Auth\DefaultPasswordHasher();

        $faker = Faker\Factory::create();
        $data[] = [
                'username'      => 'admin',
                'password'      => $hasher->hash('1234'),
                'email'         => 'erickaragol@gmail.com',
                'nombres'       => 'Erisk',
                'apellidos'     => 'Aragol',
                'activo'        => 1,
                'role'     => 'admin',
                'usuario_id'     => 1,
                'created'       => date('Y-m-d H:i:s'),
            ];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'username'      => $faker->userName,
                'password'      => $hasher->hash($faker->password),
                'email'         => $faker->email,
                'nombres'       => $faker->firstName,
                'apellidos'     => $faker->lastName,
                'activo'        => 1,
                'role'          => 'usuario',
                'created'       => date('Y-m-d H:i:s'),
            ];
        }
        // $usuarios = TableRegistry::get('Usuarios');
        $table = $this->table('usuarios');
        $table->truncate();
        $table->insert($data)->save();
    }
}
