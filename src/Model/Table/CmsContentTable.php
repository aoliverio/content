<?php

namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsContent;

/**
 * CmsContent Model
 */
class CmsContentTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('cms_content');
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
        $this->hasMany('CmsContentMeta', [
            'foreignKey' => 'cms_content_id',
            'className' => 'Content.CmsContentMeta'
        ]);
        $this->hasMany('CmsPermission', [
            'foreignKey' => 'cms_content_id',
            'className' => 'Content.CmsPermission'
        ]);
        $this->hasMany('CmsTermRelation', [
            'foreignKey' => 'cms_content_id',
            'className' => 'Content.CmsTermRelation'
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
                ->requirePresence('parent', 'create')
                ->notEmpty('parent')
                ->requirePresence('name', 'create')
                ->notEmpty('name')
                ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
                ->requirePresence('content_title', 'create')
                ->notEmpty('content_title')
                ->requirePresence('content_description', 'create')
                ->notEmpty('content_description')
                ->requirePresence('content_excerpt', 'create')
                ->notEmpty('content_excerpt')
                ->add('content_deadline', 'valid', ['rule' => 'datetime'])
                ->requirePresence('content_deadline', 'create')
                ->notEmpty('content_deadline')
                ->requirePresence('content_password', 'create')
                ->notEmpty('content_password')
                ->requirePresence('content_status', 'create')
                ->notEmpty('content_status')
                ->requirePresence('content_path', 'create')
                ->notEmpty('content_path')
                ->requirePresence('content_type', 'create')
                ->notEmpty('content_type')
                ->requirePresence('content_mime_type', 'create')
                ->notEmpty('content_mime_type')
                ->add('publish_start', 'valid', ['rule' => 'datetime'])
                ->requirePresence('publish_start', 'create')
                ->notEmpty('publish_start')
                ->add('publish_end', 'valid', ['rule' => 'datetime'])
                ->requirePresence('publish_end', 'create')
                ->notEmpty('publish_end')
                ->add('author', 'valid', ['rule' => 'numeric'])
                ->requirePresence('author', 'create')
                ->notEmpty('author')
                ->add('menu_order', 'valid', ['rule' => 'numeric'])
                ->requirePresence('menu_order', 'create')
                ->notEmpty('menu_order');

        return $validator;
    }

}
