<?php
namespace Content\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Content\Model\Table\CmsContentTypesTable;

/**
 * Content\Model\Table\CmsContentTypesTable Test Case
 */
class CmsContentTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Content\Model\Table\CmsContentTypesTable
     */
    public $CmsContentTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.content.cms_content_types',
        'plugin.content.cms_contents',
        'plugin.content.cms_content_statues',
        'plugin.content.cms_sites',
        'plugin.content.cms_site_options',
        'plugin.content.cms_site_users',
        'plugin.content.users',
        'plugin.content.cms_terms',
        'plugin.content.cms_term_taxonomies',
        'plugin.content.cms_term_relationships',
        'plugin.content.csm_term_users',
        'plugin.content.authors',
        'plugin.content.cms_content_options'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CmsContentTypes') ? [] : ['className' => 'Content\Model\Table\CmsContentTypesTable'];
        $this->CmsContentTypes = TableRegistry::get('CmsContentTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsContentTypes);

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
