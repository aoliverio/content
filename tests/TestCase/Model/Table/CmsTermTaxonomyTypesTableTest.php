<?php
namespace Content\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Content\Model\Table\CmsTermTaxonomyTypesTable;

/**
 * Content\Model\Table\CmsTermTaxonomyTypesTable Test Case
 */
class CmsTermTaxonomyTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Content\Model\Table\CmsTermTaxonomyTypesTable
     */
    public $CmsTermTaxonomyTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.content.cms_term_taxonomy_types',
        'plugin.content.cms_term_taxonomies',
        'plugin.content.cms_terms',
        'plugin.content.cms_sites',
        'plugin.content.csm_term_users',
        'plugin.content.cms_term_relationships'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CmsTermTaxonomyTypes') ? [] : ['className' => 'Content\Model\Table\CmsTermTaxonomyTypesTable'];
        $this->CmsTermTaxonomyTypes = TableRegistry::get('CmsTermTaxonomyTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsTermTaxonomyTypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
