<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\NavLinkHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\NavLinkHelper Test Case
 */
class NavLinkHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\NavLinkHelper
     */
    protected $NavLink;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->NavLink = new NavLinkHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->NavLink);

        parent::tearDown();
    }
}
