<?php
namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsTermTaxonomyType;

/**
 * CmsTermTaxonomyTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $CmsTermTaxonomies
 */
class CmsTermTaxonomyTypesTable extends Table
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

        $this->table('cms_term_taxonomy_types');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('CmsTermTaxonomies', [
            'foreignKey' => 'cms_term_taxonomy_type_id',
            'className' => 'Content.CmsTermTaxonomies'
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

        return $validator;
    }
}
