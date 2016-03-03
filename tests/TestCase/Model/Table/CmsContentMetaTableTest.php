<?php
namespace Content\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Content\Model\Table\CmsContentMetaTable;

/**
 * Content\Model\Table\CmsContentMetaTable Test Case
 */
class CmsContentMetaTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'CmsContentMeta' => 'plugin.content.cms_content_meta',
        'CmsContent' => 'plugin.content.cms_content',
        'CmsPermission' => 'plugin.content.cms_permission',
        'CmsTerm' => 'plugin.content.cms_term',
        'CmsTermRelation' => 'plugin.content.cms_term_relation',
        'CmsTermTaxonomy' => 'plugin.content.cms_term_taxonomy'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CmsContentMeta') ? [] : ['className' => 'Content\Model\Table\CmsContentMetaTable'];
        $this->CmsContentMeta = TableRegistry::get('CmsContentMeta', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsContentMeta);

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
