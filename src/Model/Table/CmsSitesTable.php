<?php
namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsSite;

/**
 * CmsSites Model
 *
 * @property \Cake\ORM\Association\HasMany $CmsContents
 * @property \Cake\ORM\Association\HasMany $CmsSiteOptions
 * @property \Cake\ORM\Association\HasMany $CmsSiteUsers
 * @property \Cake\ORM\Association\HasMany $CmsTerms
 */
class CmsSitesTable extends Table
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

        $this->table('cms_sites');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('CmsContents', [
            'foreignKey' => 'cms_site_id',
            'className' => 'Content.CmsContents'
        ]);
        $this->hasMany('CmsSiteOptions', [
            'foreignKey' => 'cms_site_id',
            'className' => 'Content.CmsSiteOptions'
        ]);
        $this->hasMany('CmsSiteUsers', [
            'foreignKey' => 'cms_site_id',
            'className' => 'Content.CmsSiteUsers'
        ]);
        $this->hasMany('CmsTerms', [
            'foreignKey' => 'cms_site_id',
            'className' => 'Content.CmsTerms'
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
            ->requirePresence('domain', 'create')
            ->notEmpty('domain');

        return $validator;
    }
}
