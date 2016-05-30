<?php
namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsContentType;

/**
 * CmsContentTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $CmsContents
 * @property \Cake\ORM\Association\HasMany $CmsTermTaxonomies
 */
class CmsContentTypesTable extends Table
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

        $this->table('cms_content_types');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('CmsContents', [
            'foreignKey' => 'cms_content_type_id',
            'className' => 'Content.CmsContents'
        ]);
        $this->hasMany('CmsTermTaxonomies', [
            'foreignKey' => 'cms_content_type_id',
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

        $validator
            ->allowEmpty('params');

        return $validator;
    }
}
