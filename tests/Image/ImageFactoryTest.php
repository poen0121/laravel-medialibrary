<?php

namespace Spatie\Medialibrary\Tests\Image;

use ReflectionClass;
use Spatie\Medialibrary\Support\ImageFactory;
use Spatie\Medialibrary\Tests\TestCase;

class ImageFactoryTest extends TestCase
{
    /** @test */
    public function loading_an_image_uses_the_correct_driver()
    {
        config(['medialibrary.image_driver' => 'imagick']);

        $image = ImageFactory::load($this->getTestJpg());

        $reflection = new ReflectionClass($image);

        $imageDriver = $reflection->getProperty('imageDriver');

        $imageDriver->setAccessible(true);

        $imageDriverValue = $imageDriver->getValue($image);

        $this->assertEquals('imagick', $imageDriverValue);
    }
}