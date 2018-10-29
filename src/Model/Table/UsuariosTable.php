<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Usuarios Model
 *
 * @method \App\Model\Entity\Usuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Usuario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Usuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Usuario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsuariosTable extends Table
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

        $this->setTable('usuarios');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        // $this->hasMany('UsuariosRutas', [
        //     'foreignKey' => 'usuario_id',
        //     'joinType' => 'INNER'
        // ]);
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
            ->scalar('username')
            ->maxLength('username', 20)
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 60)
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->scalar('nombres')
            ->maxLength('nombres', 50)
            ->requirePresence('nombres', 'create')
            ->notEmpty('nombres');

        $validator
            ->scalar('apellidos')
            ->maxLength('apellidos', 50)
            ->requirePresence('apellidos', 'create')
            ->notEmpty('apellidos');

        $validator
            ->boolean('activo')
            ->requirePresence('activo', 'create')
            ->notEmpty('activo');

        $validator
            ->dateTime('deleted')
            ->requirePresence('deleted', 'create')
            ->notEmpty('deleted');

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
        $rules->add($rules->isUnique(['username']));

        return $rules;
    }

    public function findAuth(\Cake\ORM\Query $query, array $options)
    {
        // pr($query->toArray());
        // exit;
        $query->select(['id', 'email', 'password','role','nombres','apellidos','activo']);

        return $query;
    }

    public function beforeSave(\Cake\Event\Event $event)
    {
        $entity = $event->data['entity'];

        if (isset($entity->password) && $entity->password) {
            $hasher = new \Cake\Auth\DefaultPasswordHasher();
            $entity->password = $hasher->hash($entity->password);
        }

        return true;
    }
}
