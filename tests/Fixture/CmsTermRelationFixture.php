<?php
namespace Content\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CmsTermRelationFixture
 *
 */
class CmsTermRelationFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'cms_term_relation';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'cms_term_taxonomy_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cms_content_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'menu_order' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created_user' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified_user' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_cms_term_relation_cms_term_taxonomy1_idx' => ['type' => 'index', 'columns' => ['cms_term_taxonomy_id'], 'length' => []],
            'fk_cms_term_relation_cms_content1_idx' => ['type' => 'index', 'columns' => ['cms_content_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_cms_term_relation_cms_content1' => ['type' => 'foreign', 'columns' => ['cms_content_id'], 'references' => ['cms_content', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_cms_term_relation_cms_term_taxonomy1' => ['type' => 'foreign', 'columns' => ['cms_term_taxonomy_id'], 'references' => ['cms_term_taxonomy', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => '',
            'cms_term_taxonomy_id' => '',
            'cms_content_id' => '',
            'menu_order' => 1,
            'created' => '2015-09-30 10:37:31',
            'created_user' => 1,
            'modified' => '2015-09-30 10:37:31',
            'modified_user' => 1
        ],
    ];
}
