<?php

namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsTermTaxonomy;

/**
 * CmsTermTaxonomy Model
 */
class CmsTermTaxonomyTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('cms_term_taxonomy');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'modified' => 'always',
                ]
            ]
        ]);
        $this->belongsTo('ParentCmsTermTaxonomy', [
            'className' => 'Content.CmsTermTaxonomy',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('CmsTerm', [
            'foreignKey' => 'cms_term_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsTerm'
        ]);
        $this->hasMany('CmsTermRelation', [
            'foreignKey' => 'cms_term_taxonomy_id',
            'className' => 'Content.CmsTermRelation'
        ]);
        $this->hasMany('ChildCmsTermTaxonomy', [
            'className' => 'Content.CmsTermTaxonomy',
            'foreignKey' => 'parent_id'
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
                ->requirePresence('taxonomy', 'create')
                ->notEmpty('taxonomy')
                ->requirePresence('title', 'create')
                ->notEmpty('title')
                ->allowEmpty('description');
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
        $rules->add($rules->existsIn(['parent_id'], 'ParentCmsTermTaxonomy'));
        $rules->add($rules->existsIn(['cms_term_id'], 'CmsTerm'));
        return $rules;
    }

}
