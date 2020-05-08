<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\RandomNamesComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\RandomNamesComponent Test Case
 */
class RandomNamesComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\RandomNamesComponent
     */
    protected $RandomNames;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->RandomNames = new RandomNamesComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RandomNames);

        parent::tearDown();
    }
}
