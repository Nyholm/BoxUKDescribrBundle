<?php

namespace BoxUK\Bundle\DescribrBundle\Service;

use Symfony\Component\HttpFoundation\File\File;
use BoxUK\Describr\Facade;
use BoxUK\Describr\MediaFileAttributes;

/**
 * Wraps the Describr facade class to allow File objects to be analyzed
 */
class Analyzer
{
    /**
     * @var Facade 
     */
    private $facade;
    
    /**
     * @param Facade $facade 
     */
    public function __construct(Facade $facade)
    {
        $this->facade = $facade;
    }
    
    /**
     * Attempts to retrieve metadata for the given file using Describr
     *
     * @param File $file
     * 
     * @return MediaFileAttributes 
     */
    public function analyze(File $file)
    {
        $path = $file->getRealPath();
        
        $metadata = $this->facade->describeFile($path);
        
        return $metadata;
    }
}
