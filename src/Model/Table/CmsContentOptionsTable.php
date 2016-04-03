<?php
namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsContentOption;

/**
 * CmsContentOptions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CmsContents
 */
class CmsContentOptionsTable extends Table
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

        $this->table('cms_content_options');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('CmsContents', [
            'foreignKey' => 'cms_content_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsContents'
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
            ->requirePresence('option_key', 'create')
            ->notEmpty('option_key');

        $validator
            ->requirePresence('option_value', 'create')
            ->notEmpty('option_value');

        $validator
            ->integer('menu_order')
            ->allowEmpty('menu_order');

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
        $rules->add($rules->existsIn(['cms_content_id'], 'CmsContents'));
        return $rules;
    }
}
