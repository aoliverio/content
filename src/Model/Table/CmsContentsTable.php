<?php
namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsContent;

/**
 * CmsContents Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentCmsContents
 * @property \Cake\ORM\Association\BelongsTo $CmsContentStatues
 * @property \Cake\ORM\Association\BelongsTo $CmsContentTypes
 * @property \Cake\ORM\Association\BelongsTo $CmsSites
 * @property \Cake\ORM\Association\BelongsTo $Authors
 * @property \Cake\ORM\Association\HasMany $CmsContentOptions
 * @property \Cake\ORM\Association\HasMany $ChildCmsContents
 * @property \Cake\ORM\Association\HasMany $CmsTermRelationships
 */
class CmsContentsTable extends Table
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

        $this->table('cms_contents');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ParentCmsContents', [
            'className' => 'Content.CmsContents',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('CmsContentStatues', [
            'foreignKey' => 'cms_content_status_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsContentStatues'
        ]);
        $this->belongsTo('CmsContentTypes', [
            'foreignKey' => 'cms_content_type_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsContentTypes'
        ]);
        $this->belongsTo('CmsSites', [
            'foreignKey' => 'cms_site_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsSites'
        ]);
        $this->belongsTo('Authors', [
            'foreignKey' => 'author_id',
            'className' => 'Users'
        ]);
        $this->hasMany('CmsContentOptions', [
            'foreignKey' => 'cms_content_id',
            'className' => 'Content.CmsContentOptions'
        ]);
        $this->hasMany('ChildCmsContents', [
            'className' => 'Content.CmsContents',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('CmsTermRelationships', [
            'foreignKey' => 'cms_content_id',
            'className' => 'Content.CmsTermRelationships'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('content_title', 'create')
            ->notEmpty('content_title');

        $validator
            ->allowEmpty('content_description');

        $validator
            ->allowEmpty('content_excerpt');

        $validator
            ->dateTime('content_expiry')
            ->allowEmpty('content_expiry');

        $validator
            ->allowEmpty('content_password');

        $validator
            ->allowEmpty('content_path');

        $validator
            ->allowEmpty('content_mime_type');

        $validator
            ->dateTime('publish_start')
            ->requirePresence('publish_start', 'create')
            ->notEmpty('publish_start');

        $validator
            ->dateTime('publish_end')
            ->requirePresence('publish_end', 'create')
            ->notEmpty('publish_end');

        $validator
            ->allowEmpty('guid');

        $validator
            ->integer('menu_order')
            ->allowEmpty('menu_order');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentCmsContents'));
        $rules->add($rules->existsIn(['cms_content_status_id'], 'CmsContentStatues'));
        $rules->add($rules->existsIn(['cms_content_type_id'], 'CmsContentTypes'));
        $rules->add($rules->existsIn(['cms_site_id'], 'CmsSites'));
        $rules->add($rules->existsIn(['author_id'], 'Authors'));
        return $rules;
    }
}
