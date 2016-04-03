<?php
namespace Content\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Content\Model\Table\CmsTermsTable;

/**
 * Content\Model\Table\CmsTermsTable Test Case
 */
class CmsTermsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Content\Model\Table\CmsTermsTable
     */
    public $CmsTerms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.content.cms_terms',
        'plugin.content.cms_sites',
        'plugin.content.cms_term_taxonomies',
        'plugin.content.csm_term_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CmsTerms') ? [] : ['className' => 'Content\Model\Table\CmsTermsTable'];
        $this->CmsTerms = TableRegistry::get('CmsTerms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsTerms);

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
