<?php
namespace Content\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CmsTermTaxonomiesFixture
 *
 */
class CmsTermTaxonomiesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'parent_id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cms_term_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cms_content_type_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'title' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'description' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'count' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'parent_id' => ['type' => 'index', 'columns' => ['parent_id'], 'length' => []],
            'fk_cms_terms1_idx' => ['type' => 'index', 'columns' => ['cms_term_id'], 'length' => []],
            'fk_cms_content_types1_idx' => ['type' => 'index', 'columns' => ['cms_content_type_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_cms_term_taxonomies_cms_terms' => ['type' => 'foreign', 'columns' => ['cms_term_id'], 'references' => ['cms_terms', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_cms_term_taxonomies_cms_content_types' => ['type' => 'foreign', 'columns' => ['cms_content_type_id'], 'references' => ['cms_content_types', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'parent_id' => 1,
            'cms_term_id' => 1,
            'cms_content_type_id' => 1,
            'title' => 'Lorem ipsum dolor sit amet',
            'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'count' => 1
        ],
    ];
}
