<?php
namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsSiteOption;

/**
 * CmsSiteOptions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CmsSites
 */
class CmsSiteOptionsTable extends Table
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

        $this->table('cms_site_options');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('CmsSites', [
            'foreignKey' => 'cms_site_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsSites'
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
        $rules->add($rules->existsIn(['cms_site_id'], 'CmsSites'));
        return $rules;
    }
}
