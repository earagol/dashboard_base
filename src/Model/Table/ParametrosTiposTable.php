<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * ParametrosTipos Model
 *
 * @property \App\Model\Table\UsuariosTable|\Cake\ORM\Association\BelongsTo $Usuarios
 *
 * @method \App\Model\Entity\ParametrosTipo get($primaryKey, $options = [])
 * @method \App\Model\Entity\ParametrosTipo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ParametrosTipo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ParametrosTipo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParametrosTipo|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParametrosTipo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ParametrosTipo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ParametrosTipo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ParametrosTiposTable extends Table
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

        $this->setTable('parametros_tipos');
        $this->setDisplayField('nombre');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER'
        ]);

        $this->hasmany('ParametrosValores', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER'
        ]);

        $this->addAssociations([
            'belongsToMany' => [
                'Valores' => [
                    'className' => 'ParametrosValores',
                    // 'joinTable' => 'UsuariosRutas',
                    'foreignKey' => 'parametro_tipo_id',
                    // 'targetForeignKey' => 'parametro_tipo_id'
                ]
            ]
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
            ->scalar('nombre')
            ->maxLength('nombre', 50)
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

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
        $rules->add($rules->existsIn(['usuario_id'], 'Usuarios'));

        return $rules;
    }
}
