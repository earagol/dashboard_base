<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * VentaDetalles Model
 *
 * @property \App\Model\Table\VentasTable|\Cake\ORM\Association\BelongsTo $Ventas
 * @property \App\Model\Table\ProductosTable|\Cake\ORM\Association\BelongsTo $Productos
 * @property \App\Model\Table\PreciosTable|\Cake\ORM\Association\BelongsTo $Precios
 *
 * @method \App\Model\Entity\VentaDetalle get($primaryKey, $options = [])
 * @method \App\Model\Entity\VentaDetalle newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VentaDetalle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VentaDetalle|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VentaDetalle|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VentaDetalle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VentaDetalle[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VentaDetalle findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VentaDetallesTable extends Table
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

        $this->setTable('venta_detalles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Ventas', [
            'foreignKey' => 'venta_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Productos', [
            'foreignKey' => 'producto_id',
            'joinType' => 'INNER'
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
            ->numeric('precio_unitario')
            ->requirePresence('precio_unitario', 'create')
            ->notEmpty('precio_unitario');

        $validator
            ->integer('cantidad')
            ->requirePresence('cantidad', 'create')
            ->notEmpty('cantidad');

        $validator
            ->numeric('total')
            ->requirePresence('total', 'create')
            ->notEmpty('total');

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
        $rules->add($rules->existsIn(['venta_id'], 'Ventas'));
        $rules->add($rules->existsIn(['producto_id'], 'Productos'));

        return $rules;
    }
}
