<?php
use Migrations\AbstractMigration;

class EstrellaBaseDatos extends AbstractMigration
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

        $tableRutas = $this->table('rutas')
        ->addColumn('nombres', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ])
        ->addColumn('usuario_id', 'integer', [
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

        $tableRutas = $this->table('usuarios_rutas')
        ->addColumn('usuario_id', 'integer', [
            'null' => false,
        ])
        ->addColumn('ruta_id', 'integer', [
            'null' => false,
        ])
        ->addColumn('user_id', 'integer', [
            'default' => null,
            'null' => false,
            'comment' => 'administrador que creo el registro'
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


        $tableClientes = $this->table('clientes')
        ->addColumn('ruta_id', 'integer', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('clasificacion_id', 'integer', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('tipo', 'enum', [
            'values' => [1, 2],
            'comment' => '1 para personas, 2 para empresas'
        ])
        ->addColumn('razon_social', 'string', [
            'default' => null,
            'limit' => 100,
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
        ->addColumn('sexo', 'enum', [
            'values' => ['N', 'M', 'F', 'O'],
            'comment' => 'Ninguno, Masculico, Femenino, Otro'
        ])
        ->addColumn('rut', 'string', [
            'default' => null,
            'limit' => 10,
            'null' => false,
        ])
        ->addColumn('telefono1', 'string', [
            'default' => null,
            'limit' => 12,
            'null' => false,
        ])
        ->addColumn('telefono2', 'string', [
            'default' => null,
            'limit' => 12,
            'null' => true,
        ])
        ->addColumn('observacion', 'text', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('region_id', 'integer', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('comuna_id', 'integer', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('calle', 'string', [
            'default' => null,
            'limit' => 200,
            'null' => false,
        ])
        ->addColumn('numero_calle', 'string', [
            'default' => null,
            'limit' => 15,
            'null' => false,
        ])
        ->addColumn('dept_casa_oficina_numero', 'string', [
            'default' => null,
            'limit' => 15,
            'null' => true,
        ])
        ->addColumn('credito_disponible', 'float', [
            'default' => 0,
            'null' => false,
        ])
        ->addColumn('cuenta_porcobrar', 'float', [
            'default' => 0,
            'null' => false,
        ])
        ->addColumn('activo', 'boolean', [
            'default' => 1,
            'limit' => 1,
            'null' => false,
        ])
        ->addColumn('usuario_id', 'integer', [
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


        $tableCategorias = $this->table('categorias')
        ->addColumn('nombre', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ])
        ->addColumn('usuario_id', 'integer', [
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


        $tableProductos = $this->table('productos')
        ->addColumn('categoria_id', 'integer', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('nombre', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ])
        ->addColumn('descripcion', 'text', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('usuario_id', 'integer', [
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



        $tableProductosPrecios = $this->table('productos_precios')
        ->addColumn('producto_id', 'integer', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('precio', 'float', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ])
        ->addColumn('usuario_id', 'integer', [
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


        $tableUsuarios = $this->table('usuarios');
        $tableUsuarios->renameColumn('user_id', 'usuario_id')
           ->update();


        $tableVisitas = $this->table('visitas')
        ->addColumn('usuario_id', 'integer', [
            'default' => null,
            'null' => false,
            'comment' => 'Vendedor a quien se le asigna la visita',
        ])
        ->addColumn('cliente_id', 'integer', [
            'default' => null,
            'null' => false,
            'comment' => 'Cliente que se le realizara la visita',
        ])
        ->addColumn('observacion', 'text', [
            'default' => null,
            'null' => true,
        ])
        ->addColumn('fecha_vencimiento', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('status', 'enum', [
            'values' => ['P', 'V', 'R'],
            'comment' => 'Pendiente, Vencida, Realizada'
        ])
        ->addColumn('user_id', 'integer', [
            'default' => null,
            'null' => false,
            'comment' => 'Administrador que realizo el registro',
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


        $tableVentas = $this->table('ventas')
        ->addColumn('cliente_id', 'integer', [
            'default' => null,
            'null' => false,
            'comment' => 'Cliente que se le realiza la venta',
        ])
        ->addColumn('usuario_id', 'integer', [
            'default' => null,
            'null' => false,
            'comment' => 'Vendedor que realiza la venta',
        ])
        ->addColumn('monto_total', 'float', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('efectivo', 'boolean', [
            'default' => 0,
            'null' => false
        ])
        ->addColumn('monto_efectivo', 'float', [
            'default' => null,
            'null' => true,
        ])
        ->addColumn('transferencia', 'boolean', [
            'default' => 0,
            'null' => false
        ])
        ->addColumn('monto_transferencia', 'float', [
            'default' => null,
            'null' => true,
        ])
        ->addColumn('cuenta_porcobrar', 'float', [
            'default' => null,
            'null' => true,
        ])
        ->addColumn('pago_cartera', 'boolean', [
            'default' => 0,
            'null' => false,
        ])
        ->addColumn('ano', 'integer', [
            'default' => null,
            'null' => false,
            'comment' => 'Año de la venta, campo para facilitar estadisticas',
        ])
        ->addColumn('mes', 'integer', [
            'default' => null,
            'null' => false,
            'comment' => 'Mes de la venta, campo para facilitar estadisticas',
        ])
        ->addColumn('dia', 'integer', [
            'default' => null,
            'null' => false,
            'comment' => 'Dia de la venta, campo para facilitar estadisticas',
        ])
        ->addColumn('observacion', 'text', [
            'default' => null,
            'null' => true,
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


        $tableDetalleVentas = $this->table('venta_detalles')
        ->addColumn('venta_id', 'integer', [
            'default' => null,
            'null' => false
        ])
        ->addColumn('producto_id', 'integer', [
            'default' => null,
            'null' => false
        ])
        ->addColumn('precio_id', 'integer', [
            'default' => null,
            'null' => false
        ])
        ->addColumn('precio_unitario', 'float', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('cantidad', 'integer', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('total', 'float', [
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


        $table = $this->table('control_deuda_pagos')
        ->addColumn('tipo', 'enum', [
            'values' => ['A', 'P'],
            'comment' => 'Activo,Pasivo'
        ])
        ->addColumn('cliente_id', 'integer', [
            'default' => null,
            'null' => false
        ])
        ->addColumn('monto', 'float', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('monto_efectivo', 'float', [
            'default' => null,
            'null' => true,
        ])
        ->addColumn('monto_cheque', 'float', [
            'default' => null,
            'null' => true,
        ])
        ->addColumn('monto_transferencia', 'float', [
            'default' => null,
            'null' => true,
        ])
        ->addColumn('usuario_id', 'integer', [
            'default' => null,
            'null' => false
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



        $tableParametrosTipos = $this->table('parametros_tipos')
        ->addColumn('tipo', 'enum', [
            'values' => ['Diario', 'Gasto'],
            'comment' => 'Diarios = Inicial,Recargas,Perdidas,Ventas | Gasto = Estacionamiento, Almuerzo, Combustible'
        ])
        ->addColumn('nombre', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false
        ])
        ->addColumn('usuario_id', 'integer', [
            'default' => null,
            'null' => false
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



        $tableParametros = $this->table('parametros_valores')
        ->addColumn('tipo_id', 'integer', [
            'default' => null,
            'null' => false
        ])
        ->addColumn('producto_id', 'integer', [
            'default' => null,
            'null' => true
        ])
        ->addColumn('monto_o_cantidad', 'float', [
            'default' => null,
            'null' => false
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
}
