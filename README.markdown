Introduction
============

This bundle integrates the [Describr](http://github.com/boxuk/describr) library into your Symfony2 project, allowing it to examine files and extract metadata from them.

Installation
------------

## Download the bundle

You can download an archive of the bundle and unpack it in the `vendor/bundles/BoxUK/Bundles/DescribrBundle` directory of your application.

### Installing via Composer (recommended)

The bundle can be installed using [Composer](http://getcomposer.org) by adding the following to your `composer.json`: 

    require: {
        "boxuk/describr-bundle": "dev-master"
    }

## Register the bundle

You must register the bundle in your kernel:

``` php
<?php

// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(

        // ...

        new \BoxUK\Bundle\DescribrBundle\BoxUKDescribrBundle()
    );

    // ...
}
```

Usage
-----
The bundle provides a `boxuk_describr.analyzer` service which can be used to determine metadata for any instance of `Symfony\Component\HttpFoundation\File\File`:

``` php
<?php

public function analyzeMetadata(File $file)
{
    $service = $this->getContainer()->get('boxuk_describr.analyzer');
    
    $metadata = $service->analyze($file);
    
    // Instance of BoxUK\Describr\MediaFileAttributes
    return $metadata;
}
```

See the [Describr documentation](http://github.com/boxuk/describr#using-describr) for more details.