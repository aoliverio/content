<?php
namespace Content\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Content\Model\Table\CmsTermRelationTable;

/**
 * Content\Model\Table\CmsTermRelationTable Test Case
 */
class CmsTermRelationTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'CmsTermRelation' => 'plugin.content.cms_term_relation',
        'CmsTermTaxonomy' => 'plugin.content.cms_term_taxonomy',
        'CmsTerm' => 'plugin.content.cms_term',
        'CmsPermission' => 'plugin.content.cms_permission',
        'CmsContent' => 'plugin.content.cms_content'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CmsTermRelation') ? [] : ['className' => 'Content\Model\Table\CmsTermRelationTable'];
        $this->CmsTermRelation = TableRegistry::get('CmsTermRelation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsTermRelation);

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
