<?php
namespace Content\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Content\Model\Table\CmsTermTaxonomiesTable;

/**
 * Content\Model\Table\CmsTermTaxonomiesTable Test Case
 */
class CmsTermTaxonomiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Content\Model\Table\CmsTermTaxonomiesTable
     */
    public $CmsTermTaxonomies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.content.cms_term_taxonomies',
        'plugin.content.cms_terms',
        'plugin.content.cms_sites',
        'plugin.content.csm_term_users',
        'plugin.content.cms_term_taxonomy_types',
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
        $config = TableRegistry::exists('CmsTermTaxonomies') ? [] : ['className' => 'Content\Model\Table\CmsTermTaxonomiesTable'];
        $this->CmsTermTaxonomies = TableRegistry::get('CmsTermTaxonomies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsTermTaxonomies);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
