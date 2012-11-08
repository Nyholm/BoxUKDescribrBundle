<?php

namespace BoxUK\Bundle\DescribrBundle\Tests\Functional;

use Symfony\Component\Filesystem\Filesystem;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    private $kernel;

    public function setUp()
    {
        $this->kernel = new TestKernel('test', false);
        $this->kernel->boot();
    }

    public function testAnalyzerServiceIsRegisteredForDevEnvironment()
    {
        $kernel = new TestKernel('dev', false);
        $kernel->boot();

        $container = $kernel->getContainer();
        $this->assertInstanceOf('BoxUK\Bundle\DescribrBundle\Service\Analyzer', $container->get('boxuk_describr.analyzer'));
    }

    public function testAnalyzerServiceIsRegisteredForTestEnvironment()
    {
        $this->assertInstanceOf('BoxUK\Bundle\DescribrBundle\Service\Analyzer', $this->kernel->getContainer()->get('boxuk_describr.analyzer'));
    }
    
    public function testFacadeServiceIsNotPublic()
    {
        $this->setExpectedException(
            'Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException', 
            'You have requested a non-existent service "boxuk_describr.facade"'
        );
        
        $this->kernel->getContainer()->get('boxuk_describr.facade');
    }
}