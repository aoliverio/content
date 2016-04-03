<?php
namespace Content\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CmsTermRelationshipsFixture
 *
 */
class CmsTermRelationshipsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'cms_content_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cms_term_taxonomy_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'menu_order' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_cms_contents1_idx' => ['type' => 'index', 'columns' => ['cms_content_id'], 'length' => []],
            'fk_cms_term_taxonomy1_idx' => ['type' => 'index', 'columns' => ['cms_term_taxonomy_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_cms_term_relationships_cms_contents' => ['type' => 'foreign', 'columns' => ['cms_content_id'], 'references' => ['cms_contents', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_cms_term_relationships_cms_term_taxonomy' => ['type' => 'foreign', 'columns' => ['cms_term_taxonomy_id'], 'references' => ['cms_term_taxonomies', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'cms_content_id' => 1,
            'cms_term_taxonomy_id' => 1,
            'menu_order' => 1
        ],
    ];
}
