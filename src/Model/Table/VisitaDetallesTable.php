<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * VisitaDetalles Model
 *
 * @property \App\Model\Table\VisitasTable|\Cake\ORM\Association\BelongsTo $Visitas
 * @property \App\Model\Table\ProductosTable|\Cake\ORM\Association\BelongsTo $Productos
 * @property \App\Model\Table\PreciosTable|\Cake\ORM\Association\BelongsTo $Precios
 *
 * @method \App\Model\Entity\VisitaDetalle get($primaryKey, $options = [])
 * @method \App\Model\Entity\VisitaDetalle newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VisitaDetalle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VisitaDetalle|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VisitaDetalle|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VisitaDetalle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VisitaDetalle[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VisitaDetalle findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VisitaDetallesTable extends Table
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

        $this->setTable('visita_detalles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Visitas', [
            'foreignKey' => 'visita_id',
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
        $rules->add($rules->existsIn(['visita_id'], 'Visitas'));
        $rules->add($rules->existsIn(['producto_id'], 'Productos'));

        return $rules;
    }
}
