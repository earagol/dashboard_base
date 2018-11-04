<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * ControlDeudaPagos Model
 *
 * @property \App\Model\Table\ClientesTable|\Cake\ORM\Association\BelongsTo $Clientes
 * @property \App\Model\Table\UsuariosTable|\Cake\ORM\Association\BelongsTo $Usuarios
 * @property \App\Model\Table\VentasTable|\Cake\ORM\Association\BelongsTo $Ventas
 *
 * @method \App\Model\Entity\ControlDeudaPago get($primaryKey, $options = [])
 * @method \App\Model\Entity\ControlDeudaPago newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ControlDeudaPago[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ControlDeudaPago|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ControlDeudaPago|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ControlDeudaPago patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ControlDeudaPago[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ControlDeudaPago findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ControlDeudaPagosTable extends Table
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

        $this->setTable('control_deuda_pagos');
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
        $this->belongsTo('Ventas', [
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
            ->scalar('tipo')
            ->requirePresence('tipo', 'create')
            ->notEmpty('tipo');

        $validator
            ->numeric('monto')
            ->requirePresence('monto', 'create')
            ->notEmpty('monto');

        $validator
            ->numeric('monto_efectivo')
            ->allowEmpty('monto_efectivo');

        $validator
            ->numeric('monto_cheque')
            ->allowEmpty('monto_cheque');

        $validator
            ->numeric('monto_transferencia')
            ->allowEmpty('monto_transferencia');

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
        $rules->add($rules->existsIn(['venta_id'], 'Ventas'));

        return $rules;
    }
}
