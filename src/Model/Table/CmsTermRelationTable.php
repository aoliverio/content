<?php

namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsTermRelation;

/**
 * CmsTermRelation Model
 */
class CmsTermRelationTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('cms_term_relation');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'modified' => 'always',
                ]
            ]
        ]);
        $this->belongsTo('CmsTermTaxonomy', [
            'foreignKey' => 'cms_term_taxonomy_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsTermTaxonomy'
        ]);
        $this->belongsTo('CmsContent', [
            'foreignKey' => 'cms_content_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsContent'
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
                ->add('menu_order', 'valid', ['rule' => 'numeric'])
                ->requirePresence('menu_order', 'create')
                ->notEmpty('menu_order');

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
        $rules->add($rules->existsIn(['cms_term_taxonomy_id'], 'CmsTermTaxonomy'));
        $rules->add($rules->existsIn(['cms_content_id'], 'CmsContent'));
        return $rules;
    }

}
