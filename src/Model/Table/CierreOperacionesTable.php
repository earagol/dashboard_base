<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CierreOperaciones Model
 *
 * @property \App\Model\Table\VendedorsTable|\Cake\ORM\Association\BelongsTo $Vendedors
 * @property \App\Model\Table\AdminsTable|\Cake\ORM\Association\BelongsTo $Admins
 *
 * @method \App\Model\Entity\CierreOperacione get($primaryKey, $options = [])
 * @method \App\Model\Entity\CierreOperacione newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CierreOperacione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CierreOperacione|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CierreOperacione|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CierreOperacione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CierreOperacione[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CierreOperacione findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CierreOperacionesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('cierre_operaciones');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Vendedor', [
            'foreignKey' => 'vendedor_id',
            'joinType' => 'INNER',
            'className' => 'Usuarios'
        ]);
        $this->belongsTo('Admin', [
            'foreignKey' => 'admin_id',
            'joinType' => 'INNER',
            'className' => 'Usuarios'
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
            ->date('fecha_cierre')
            ->allowEmpty('fecha_cierre');

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
        // $rules->add($rules->existsIn(['vendedor_id'], 'Vendedors'));
        // $rules->add($rules->existsIn(['admin_id'], 'Admins'));

        return $rules;
    }
}
