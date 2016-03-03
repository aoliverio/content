<?php
namespace Content\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Content\Model\Table\CmsPermissionTable;

/**
 * Content\Model\Table\CmsPermissionTable Test Case
 */
class CmsPermissionTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'CmsPermission' => 'plugin.content.cms_permission',
        'CmsContent' => 'plugin.content.cms_content',
        'CmsTermRelation' => 'plugin.content.cms_term_relation',
        'CmsTermTaxonomy' => 'plugin.content.cms_term_taxonomy',
        'CmsTerm' => 'plugin.content.cms_term'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CmsPermission') ? [] : ['className' => 'Content\Model\Table\CmsPermissionTable'];
        $this->CmsPermission = TableRegistry::get('CmsPermission', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsPermission);

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
