<?php

namespace BoxUK\Bundle\DescribrBundle\Tests\Service;

use Symfony\Component\HttpFoundation\File\File;
use BoxUK\Bundle\DescribrBundle\Service\Analyzer;

class AnalyzerTest extends \PHPUnit_Framework_TestCase
{
    public function testAnalyzeUsesInjectedFacadeAndReturnsMetadata()
    {
        $facade = $this
            ->getMockBuilder('BoxUK\Describr\Facade')
            ->setMethods(array('describeFile'))
            ->disableOriginalConstructor()
            ->getMock()
        ;
        
        $facade
            ->expects($this->once())
            ->method('describeFile')
            ->with('/path/to/file')
            ->will($this->returnValue(1))
        ;
        
        $file = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\File\File')
            ->setMethods(array('getRealPath'))
            ->disableOriginalConstructor()
            ->getMock()
        ;
        
        $file
            ->expects($this->once())
            ->method('getRealPath')
            ->will($this->returnValue('/path/to/file'))
        ;
        
        $analyzer = new Analyzer($facade);
        
        $result = $analyzer->analyze($file);
        
        $this->assertEquals(1, $result);
    }
}
