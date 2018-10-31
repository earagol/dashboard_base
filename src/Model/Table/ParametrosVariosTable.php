<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ParametrosVarios Model
 *
 * @method \App\Model\Entity\ParametrosVario get($primaryKey, $options = [])
 * @method \App\Model\Entity\ParametrosVario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ParametrosVario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ParametrosVario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParametrosVario|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParametrosVario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ParametrosVario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ParametrosVario findOrCreate($search, callable $callback = null, $options = [])
 */
class ParametrosVariosTable extends Table
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

        $this->setTable('parametros_varios');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('dias_vencer_visita')
            ->requirePresence('dias_vencer_visita', 'create')
            ->notEmpty('dias_vencer_visita');

        return $validator;
    }
}
