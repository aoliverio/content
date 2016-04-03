<?php
namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsTermTaxonomy;

/**
 * CmsTermTaxonomies Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentCmsTermTaxonomies
 * @property \Cake\ORM\Association\BelongsTo $CmsTerms
 * @property \Cake\ORM\Association\BelongsTo $CmsTermTaxonomyTypes
 * @property \Cake\ORM\Association\HasMany $CmsTermRelationships
 * @property \Cake\ORM\Association\HasMany $ChildCmsTermTaxonomies
 */
class CmsTermTaxonomiesTable extends Table
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

        $this->table('cms_term_taxonomies');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('ParentCmsTermTaxonomies', [
            'className' => 'Content.CmsTermTaxonomies',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('CmsTerms', [
            'foreignKey' => 'cms_term_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsTerms'
        ]);
        $this->belongsTo('CmsTermTaxonomyTypes', [
            'foreignKey' => 'cms_term_taxonomy_type_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsTermTaxonomyTypes'
        ]);
        $this->hasMany('CmsTermRelationships', [
            'foreignKey' => 'cms_term_taxonomy_id',
            'className' => 'Content.CmsTermRelationships'
        ]);
        $this->hasMany('ChildCmsTermTaxonomies', [
            'className' => 'Content.CmsTermTaxonomies',
            'foreignKey' => 'parent_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('title');

        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('count');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentCmsTermTaxonomies'));
        $rules->add($rules->existsIn(['cms_term_id'], 'CmsTerms'));
        $rules->add($rules->existsIn(['cms_term_taxonomy_type_id'], 'CmsTermTaxonomyTypes'));
        return $rules;
    }
}
