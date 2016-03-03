<?php
namespace Content\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CmsPermissionFixture
 *
 */
class CmsPermissionFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'cms_permission';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'cms_content_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cms_term_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'sys_user' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'sys_role' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'allow' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created_user' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified_user' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_cms_content1_idx' => ['type' => 'index', 'columns' => ['cms_content_id'], 'length' => []],
            'fk_cms_term1_idx' => ['type' => 'index', 'columns' => ['cms_term_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id', 'cms_content_id', 'cms_term_id'], 'length' => []],
            'fk_cms_content1' => ['type' => 'foreign', 'columns' => ['cms_content_id'], 'references' => ['cms_content', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_cms_term1' => ['type' => 'foreign', 'columns' => ['cms_term_id'], 'references' => ['cms_term', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'id' => 1,
            'cms_content_id' => '',
            'cms_term_id' => '',
            'sys_user' => 1,
            'sys_role' => 1,
            'allow' => 1,
            'created' => '2015-09-28 11:16:25',
            'created_user' => 1,
            'modified' => '2015-09-28 11:16:25',
            'modified_user' => 1
        ],
    ];
}
