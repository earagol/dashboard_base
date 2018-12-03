<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * Ventas Model
 *
 * @property \App\Model\Table\ClientesTable|\Cake\ORM\Association\BelongsTo $Clientes
 * @property \App\Model\Table\UsuariosTable|\Cake\ORM\Association\BelongsTo $Usuarios
 * @property \App\Model\Table\VentaDetallesTable|\Cake\ORM\Association\HasMany $VentaDetalles
 *
 * @method \App\Model\Entity\Venta get($primaryKey, $options = [])
 * @method \App\Model\Entity\Venta newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Venta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Venta|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Venta|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Venta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Venta[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Venta findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VentasTable extends Table
{
    use SoftDeleteTrait;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('ventas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('VentaDetalles', [
            'foreignKey' => 'venta_id'
        ]);

        $this->hasMany('ControlDeudaPagos', [
            'foreignKey' => 'venta_id'
        ]);

        $this->hasMany('EmbasesRetornados', [
            'foreignKey' => 'venta_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->numeric('monto_total')
            ->allowEmpty('monto_total');

        $validator
            ->boolean('efectivo')
            ->requirePresence('efectivo', 'create')
            ->notEmpty('efectivo');

        $validator
            ->numeric('monto_efectivo')
            ->allowEmpty('monto_efectivo');

        $validator
            ->boolean('transferencia')
            ->requirePresence('transferencia', 'create')
            ->notEmpty('transferencia');

        $validator
            ->numeric('monto_transferencia')
            ->allowEmpty('monto_transferencia');

        $validator
            ->numeric('cuenta_porcobrar')
            ->allowEmpty('cuenta_porcobrar');

        $validator
            ->boolean('pago_cartera')
            ->requirePresence('pago_cartera', 'create')
            ->notEmpty('pago_cartera');

        $validator
            ->numeric('monto_cartera')
            ->allowEmpty('monto_cartera');

        $validator
            ->integer('ano')
            ->requirePresence('ano', 'create')
            ->notEmpty('ano');

        $validator
            ->integer('mes')
            ->requirePresence('mes', 'create')
            ->notEmpty('mes');

        $validator
            ->integer('dia')
            ->requirePresence('dia', 'create')
            ->notEmpty('dia');

        $validator
            ->scalar('observacion')
            ->allowEmpty('observacion');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['cliente_id'], 'Clientes'));
        $rules->add($rules->existsIn(['usuario_id'], 'Usuarios'));

        return $rules;
    }
}
