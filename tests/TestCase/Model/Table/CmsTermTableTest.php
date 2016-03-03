<?php
namespace Content\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Content\Model\Table\CmsTermTable;

/**
 * Content\Model\Table\CmsTermTable Test Case
 */
class CmsTermTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'CmsTerm' => 'plugin.content.cms_term',
        'CmsPermission' => 'plugin.content.cms_permission',
        'CmsContent' => 'plugin.content.cms_content',
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
        $config = TableRegistry::exists('CmsTerm') ? [] : ['className' => 'Content\Model\Table\CmsTermTable'];
        $this->CmsTerm = TableRegistry::get('CmsTerm', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsTerm);

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
