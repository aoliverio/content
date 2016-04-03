<?php
namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsSiteRole;

/**
 * CmsSiteRoles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CmsSites
 * @property \Cake\ORM\Association\BelongsTo $Roles
 */
class CmsSiteRolesTable extends Table
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

        $this->table('cms_site_roles');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('CmsSites', [
            'foreignKey' => 'cms_sites_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsSites'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'roles_id',
            'joinType' => 'INNER',
            'className' => 'Content.Roles'
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
            ->allowEmpty('params');

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
        $rules->add($rules->existsIn(['cms_sites_id'], 'CmsSites'));
        $rules->add($rules->existsIn(['roles_id'], 'Roles'));
        return $rules;
    }
}
