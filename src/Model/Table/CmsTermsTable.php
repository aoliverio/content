<?php
namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsTerm;

/**
 * CmsTerms Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CmsSites
 * @property \Cake\ORM\Association\HasMany $CmsTermTaxonomies
 * @property \Cake\ORM\Association\HasMany $CsmTermUsers
 */
class CmsTermsTable extends Table
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

        $this->table('cms_terms');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('CmsSites', [
            'foreignKey' => 'cms_site_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsSites'
        ]);
        $this->hasMany('CmsTermTaxonomies', [
            'foreignKey' => 'cms_term_id',
            'className' => 'Content.CmsTermTaxonomies'
        ]);
        $this->hasMany('CsmTermUsers', [
            'foreignKey' => 'cms_term_id',
            'className' => 'Content.CsmTermUsers'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('title');

        $validator
            ->allowEmpty('description');

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
        $rules->add($rules->existsIn(['cms_site_id'], 'CmsSites'));
        return $rules;
    }
}
