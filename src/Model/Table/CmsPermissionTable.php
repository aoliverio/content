<?php

namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsPermission;

/**
 * CmsPermission Model
 */
class CmsPermissionTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('cms_permission');
        $this->displayField('id');
        $this->primaryKey(['id', 'cms_content_id', 'cms_term_id']);
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'modified' => 'always',
                ]
            ]
        ]);
        $this->belongsTo('CmsContent', [
            'foreignKey' => 'cms_content_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsContent'
        ]);
        $this->belongsTo('CmsTerm', [
            'foreignKey' => 'cms_term_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsTerm'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->add('id', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('id', 'create')
                ->add('sys_user', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('sys_user')
                ->add('sys_role', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('sys_role')
                ->add('allow', 'valid', ['rule' => 'boolean'])
                ->allowEmpty('allow');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['cms_content_id'], 'CmsContent'));
        $rules->add($rules->existsIn(['cms_term_id'], 'CmsTerm'));
        return $rules;
    }

}
