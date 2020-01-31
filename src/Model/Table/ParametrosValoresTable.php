<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * ParametrosValores Model
 *
 * @property \App\Model\Table\ParametroTiposTable|\Cake\ORM\Association\BelongsTo $ParametroTipos
 * @property \App\Model\Table\ProductosTable|\Cake\ORM\Association\BelongsTo $Productos
 * @property \App\Model\Table\UsuariosTable|\Cake\ORM\Association\BelongsTo $Usuarios
 *
 * @method \App\Model\Entity\ParametrosValore get($primaryKey, $options = [])
 * @method \App\Model\Entity\ParametrosValore newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ParametrosValore[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ParametrosValore|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParametrosValore|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParametrosValore patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ParametrosValore[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ParametrosValore findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ParametrosValoresTable extends Table
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

        $this->setTable('parametros_valores');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ParametrosTipos', [
            'foreignKey' => 'parametros_tipo_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Productos', [
            'foreignKey' => 'producto_id'
        ]);
        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
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
            ->numeric('monto_o_cantidad')
            ->requirePresence('monto_o_cantidad', 'create')
            ->notEmpty('monto_o_cantidad');

        // $validator
        //     ->scalar('tipo')
        //     ->maxLength('tipo', 20)
        //     ->requirePresence('tipo', 'create')
        //     ->notEmpty('tipo');

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
        // $rules->add($rules->existsIn(['producto_id'], 'Productos'));
        // $rules->add($rules->existsIn(['usuario_id'], 'Usuarios'));

        return $rules;
    }
}
