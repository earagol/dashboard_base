<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clientes Model
 *
 * @property \App\Model\Table\RutasTable|\Cake\ORM\Association\BelongsTo $Rutas
 * @property \App\Model\Table\ClasificacionsTable|\Cake\ORM\Association\BelongsTo $Clasificacions
 * @property \App\Model\Table\RegionsTable|\Cake\ORM\Association\BelongsTo $Regions
 * @property \App\Model\Table\ComunasTable|\Cake\ORM\Association\BelongsTo $Comunas
 * @property \App\Model\Table\UsuariosTable|\Cake\ORM\Association\BelongsTo $Usuarios
 * @property \App\Model\Table\ControlDeudaPagosTable|\Cake\ORM\Association\HasMany $ControlDeudaPagos
 * @property \App\Model\Table\VentasTable|\Cake\ORM\Association\HasMany $Ventas
 * @property \App\Model\Table\VisitasTable|\Cake\ORM\Association\HasMany $Visitas
 *
 * @method \App\Model\Entity\Cliente get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cliente newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cliente[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cliente|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cliente|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cliente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cliente[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cliente findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClientesTable extends Table
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

        $this->setTable('clientes');
        $this->setDisplayField('nombres');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Rutas', [
            'foreignKey' => 'ruta_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Clasificaciones', [
            'foreignKey' => 'clasificacion_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Regiones', [
            'foreignKey' => 'region_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Comunas', [
            'foreignKey' => 'comuna_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ControlDeudaPagos', [
            'foreignKey' => 'cliente_id'
        ]);
        $this->hasMany('Ventas', [
            'foreignKey' => 'cliente_id'
        ]);
        $this->hasMany('Visitas', [
            'foreignKey' => 'cliente_id'
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
            ->scalar('nombres')
            ->maxLength('nombres', 50)
            ->requirePresence('nombres', 'create')
            ->notEmpty('nombres');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->scalar('sexo')
            ->requirePresence('sexo', 'create')
            ->notEmpty('sexo');

        $validator
            ->scalar('rut')
            ->maxLength('rut', 10)
            ->requirePresence('rut', 'create')
            ->notEmpty('rut');

        $validator
            ->scalar('telefono1')
            ->maxLength('telefono1', 12)
            ->requirePresence('telefono1', 'create')
            ->notEmpty('telefono1');

        $validator
            ->scalar('telefono2')
            ->maxLength('telefono2', 12)
            ->allowEmpty('telefono2');

        $validator
            ->scalar('observacion')
            ->requirePresence('observacion', 'create')
            ->notEmpty('observacion');

        $validator
            ->scalar('calle')
            ->maxLength('calle', 200)
            ->requirePresence('calle', 'create')
            ->notEmpty('calle');

        $validator
            ->scalar('numero_calle')
            ->maxLength('numero_calle', 15)
            ->requirePresence('numero_calle', 'create')
            ->notEmpty('numero_calle');

        $validator
            ->scalar('dept_casa_oficina_numero')
            ->maxLength('dept_casa_oficina_numero', 15)
            ->allowEmpty('dept_casa_oficina_numero');

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
        // $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['ruta_id'], 'Rutas'));
        $rules->add($rules->existsIn(['clasificacion_id'], 'Clasificaciones'));
        $rules->add($rules->existsIn(['region_id'], 'Regiones'));
        $rules->add($rules->existsIn(['comuna_id'], 'Comunas'));
        // $rules->add($rules->existsIn(['usuario_id'], 'Usuarios'));

        return $rules;
    }
}
