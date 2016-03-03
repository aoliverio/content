<?php
namespace Content\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Content\Model\Table\CmsTermTaxonomyTable;

/**
 * Content\Model\Table\CmsTermTaxonomyTable Test Case
 */
class CmsTermTaxonomyTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'CmsTermTaxonomy' => 'plugin.content.cms_term_taxonomy',
        'CmsTerm' => 'plugin.content.cms_term',
        'CmsPermission' => 'plugin.content.cms_permission',
        'CmsContent' => 'plugin.content.cms_content',
        'CmsTermRelation' => 'plugin.content.cms_term_relation'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CmsTermTaxonomy') ? [] : ['className' => 'Content\Model\Table\CmsTermTaxonomyTable'];
        $this->CmsTermTaxonomy = TableRegistry::get('CmsTermTaxonomy', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsTermTaxonomy);

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
