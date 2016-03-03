<?php

namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsTerm;

/**
 * CmsTerm Model
 */
class CmsTermTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('cms_term');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'modified' => 'always',
                ]
            ]
        ]);
        $this->hasMany('CmsPermission', [
            'foreignKey' => 'cms_term_id',
            'className' => 'Content.CmsPermission'
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
                ->allowEmpty('id', 'create')
                ->requirePresence('name', 'create')
                ->notEmpty('name')
                ->requirePresence('title', 'create')
                ->notEmpty('title')
                ->requirePresence('description', 'create')
                ->notEmpty('description');

        return $validator;
    }

}
