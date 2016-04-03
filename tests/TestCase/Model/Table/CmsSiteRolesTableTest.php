<?php
namespace Content\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Content\Model\Table\CmsSiteRolesTable;

/**
 * Content\Model\Table\CmsSiteRolesTable Test Case
 */
class CmsSiteRolesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Content\Model\Table\CmsSiteRolesTable
     */
    public $CmsSiteRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.content.cms_site_roles',
        'plugin.content.cms_sites',
        'plugin.content.cms_site_options',
        'plugin.content.cms_site_users',
        'plugin.content.users',
        'plugin.content.cms_terms',
        'plugin.content.cms_term_taxonomies',
        'plugin.content.cms_term_taxonomy_types',
        'plugin.content.cms_term_relationships',
        'plugin.content.cms_contents',
        'plugin.content.cms_content_statues',
        'plugin.content.cms_content_types',
        'plugin.content.authors',
        'plugin.content.cms_content_options',
        'plugin.content.csm_term_users',
        'plugin.content.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CmsSiteRoles') ? [] : ['className' => 'Content\Model\Table\CmsSiteRolesTable'];
        $this->CmsSiteRoles = TableRegistry::get('CmsSiteRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsSiteRoles);

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
