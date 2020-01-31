<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * ParametrosValoresPadre Model
 *
 * @property \App\Model\Table\ParametrosTiposTable|\Cake\ORM\Association\BelongsTo $ParametrosTipos
 *
 * @method \App\Model\Entity\ParametrosValoresPadre get($primaryKey, $options = [])
 * @method \App\Model\Entity\ParametrosValoresPadre newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ParametrosValoresPadre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ParametrosValoresPadre|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParametrosValoresPadre|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParametrosValoresPadre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ParametrosValoresPadre[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ParametrosValoresPadre findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ParametrosValoresPadreTable extends Table
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

        $this->setTable('parametros_valores_padre');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ParametrosTipos', [
            'foreignKey' => 'parametros_tipo_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('ParametrosValores', [
            'foreignKey' => 'padre_id',
            'joinType' => 'INNER'
        ]);

         $this->belongsTo('UsuariosRutas', [
            'foreignKey' => 'usuario_id',
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
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmpty('fecha');

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
        $rules->add($rules->existsIn(['parametros_tipo_id'], 'ParametrosTipos'));

        return $rules;
    }
}
