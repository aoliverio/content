<?php
namespace Content\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Content\Model\Table\CmsContentTable;

/**
 * Content\Model\Table\CmsContentTable Test Case
 */
class CmsContentTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('CmsContent') ? [] : ['className' => 'Content\Model\Table\CmsContentTable'];
        $this->CmsContent = TableRegistry::get('CmsContent', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsContent);

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
