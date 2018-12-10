<?php
use Migrations\AbstractSeed;

/**
 * Clientes seed.
 */
class ClientesSeed extends AbstractSeed
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

        $faker = Faker\Factory::create();
        for ($i = 0; $i < 1000; $i++) {
            $data[] = [
                'ruta_id'          => rand(1,4),
                'clasificacion_id'      => rand(1,2),
                'tipo'      => rand(1,2),
                'nombres'       => $faker->firstName.' '.$faker->lastName,
                'email'     => $faker->email,
                'sexo'        => $faker->randomElement($array = array ('N','M','F','O')),
                'rut'          => rand(20000000,30000000).'-'.rand(0,9),
                'telefono1'     => $faker->e164PhoneNumber,
                'telefono2'     => $faker->e164PhoneNumber,
                'observacion'     => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'region_id'     => 1,
                'comuna_id'     => rand(1,3),
                'calle'     => $faker->streetName,
                'numero_calle'     => rand(10,200),
                'dept_casa_oficina_numero'     => rand(10,200),
                'credito_disponible'     => 0,
                'cuenta_porcobrar'     => 0,
                'activo'     => 1,
                'usuario_id'     => 1,
                'created'       => date('Y-m-d H:i:s'),
                'modified'       => date('Y-m-d H:i:s'),
            ];
        }
        $table = $this->table('clientes');
        $table->insert($data)->save();



    }
}
