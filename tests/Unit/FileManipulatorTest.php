<?php

namespace Spatie\Medialibrary\Tests\Unit;

use Spatie\Medialibrary\Features\Conversions\Conversion;
use Spatie\Medialibrary\Features\Conversions\FileManipulator;
use Spatie\Medialibrary\Tests\TestCase;

class FileManipulatorTest extends TestCase
{
    protected string $conversionName = 'test';

    /** @var \Spatie\Medialibrary\Features\Conversions\Conversion */
    protected \Spatie\Medialibrary\Features\Conversions\Conversion $conversion;

    public function setUp(): void
    {
        parent::setUp();

        $this->conversion = new Conversion($this->conversionName);
    }

    /** @test */
    public function it_does_not_perform_manipulations_if_not_necessary()
    {
        $imageFile = $this->getTestJpg();
        $media = $this->testModelWithoutMediaConversions->addMedia($this->getTestJpg())->toMediaCollection();

        $conversionTempFile = (new FileManipulator)->performManipulations(
            $media,
            $this->conversion->withoutManipulations(),
            $imageFile
        );

        $this->assertEquals($imageFile, $conversionTempFile);
    }
}
