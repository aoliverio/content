<?php
namespace Content\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Content\Model\Table\CmsContentRolesTable;

/**
 * Content\Model\Table\CmsContentRolesTable Test Case
 */
class CmsContentRolesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Content\Model\Table\CmsContentRolesTable
     */
    public $CmsContentRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.content.cms_content_roles',
        'plugin.content.cms_contents',
        'plugin.content.cms_content_statues',
        'plugin.content.cms_content_types',
        'plugin.content.authors',
        'plugin.content.cms_content_options',
        'plugin.content.cms_term_relationships',
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
        $config = TableRegistry::exists('CmsContentRoles') ? [] : ['className' => 'Content\Model\Table\CmsContentRolesTable'];
        $this->CmsContentRoles = TableRegistry::get('CmsContentRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsContentRoles);

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
