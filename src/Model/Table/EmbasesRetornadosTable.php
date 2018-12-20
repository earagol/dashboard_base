<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * EmbasesRetornados Model
 *
 * @property \App\Model\Table\ProductosTable|\Cake\ORM\Association\BelongsTo $Productos
 * @property \App\Model\Table\ClientesTable|\Cake\ORM\Association\BelongsTo $Clientes
 * @property \App\Model\Table\VentasTable|\Cake\ORM\Association\BelongsTo $Ventas
 *
 * @method \App\Model\Entity\EmbasesRetornado get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmbasesRetornado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmbasesRetornado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmbasesRetornado|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmbasesRetornado|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmbasesRetornado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmbasesRetornado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmbasesRetornado findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmbasesRetornadosTable extends Table
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

        $this->setTable('embases_retornados');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Productos', [
            'foreignKey' => 'producto_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id',
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
            ->integer('cantidad')
            ->requirePresence('cantidad', 'create')
            ->notEmpty('cantidad');

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
        $rules->add($rules->existsIn(['producto_id'], 'Productos'));
        $rules->add($rules->existsIn(['cliente_id'], 'Clientes'));
        $rules->add($rules->existsIn(['venta_id'], 'Ventas'));

        return $rules;
    }
}
