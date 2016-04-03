<?php
namespace Content\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Content\Model\Table\CmsTermRelationshipsTable;

/**
 * Content\Model\Table\CmsTermRelationshipsTable Test Case
 */
class CmsTermRelationshipsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Content\Model\Table\CmsTermRelationshipsTable
     */
    public $CmsTermRelationships;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.content.cms_term_relationships',
        'plugin.content.cms_contents',
        'plugin.content.cms_content_statues',
        'plugin.content.cms_content_types',
        'plugin.content.authors',
        'plugin.content.cms_content_options',
        'plugin.content.cms_term_taxonomies',
        'plugin.content.cms_terms',
        'plugin.content.cms_sites',
        'plugin.content.csm_term_users',
        'plugin.content.cms_term_taxonomy_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CmsTermRelationships') ? [] : ['className' => 'Content\Model\Table\CmsTermRelationshipsTable'];
        $this->CmsTermRelationships = TableRegistry::get('CmsTermRelationships', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsTermRelationships);

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
