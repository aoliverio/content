<?php
namespace Content\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Content\Model\Table\CmsContentUsersTable;

/**
 * Content\Model\Table\CmsContentUsersTable Test Case
 */
class CmsContentUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Content\Model\Table\CmsContentUsersTable
     */
    public $CmsContentUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.content.cms_content_users',
        'plugin.content.cms_contents',
        'plugin.content.cms_content_statues',
        'plugin.content.cms_content_types',
        'plugin.content.authors',
        'plugin.content.cms_content_options',
        'plugin.content.cms_term_relationships',
        'plugin.content.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CmsContentUsers') ? [] : ['className' => 'Content\Model\Table\CmsContentUsersTable'];
        $this->CmsContentUsers = TableRegistry::get('CmsContentUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsContentUsers);

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
