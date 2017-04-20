<?php declare( strict_types=1 );

namespace Tests\Admin\Form\Fields\Renderer;

use CubeSystems\Leaf\Admin\Form\Fields\Renderer\FileSize;
use CubeSystems\Leaf\Files\LeafFile;
use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

/**
 * Class FileSizeTest
 * @package Tests\Admin\Form\Fields\Renderer
 */
final class FileSizeTest extends TestCase
{
    /**
     * @var Mock|LeafFile
     */
    private $file;

    /**
     * @var FileSize
     */
    private $fileSize;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->file = Mockery::mock( LeafFile::class );
        $this->fileSize = new FileSize( $this->file );
    }

    /**
     * @return void
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     * @return void
     */
    public function itShouldHaveSizeInBytes()
    {
        $expectedFileSize = 1234560;

        /** @noinspection PhpMethodParametersCountMismatchInspection */
        $this->file->shouldReceive( 'getSize' )->andReturn( $expectedFileSize );
        $this->assertEquals( $this->fileSize->getSizeInBytes(), $expectedFileSize );
    }

    /**
     * @test
     * @return void
     */
    public function itShouldConvertSizeInBytesToReadableValue()
    {
        $this->assertSizeGetsConvertedToReadableValue( 123, '0.12 KB' );
        $this->assertSizeGetsConvertedToReadableValue( 3189, '3.19 KB' );
        $this->assertSizeGetsConvertedToReadableValue( 40960, '40.96 KB' );
        $this->assertSizeGetsConvertedToReadableValue( 590123, '0.59 MB' );
        $this->assertSizeGetsConvertedToReadableValue( 42590123, '42.59 MB' );
        $this->assertSizeGetsConvertedToReadableValue( 1042590123, '1042.59 MB' );
    }

    /**
     * @param int $sizeInBytes
     * @param string $expectedValue
     * @return void
     */
    private function assertSizeGetsConvertedToReadableValue( int $sizeInBytes, string $expectedValue )
    {
        /** @noinspection PhpMethodParametersCountMismatchInspection */
        $this->file->shouldReceive( 'getSize' )->once()->andReturn( $sizeInBytes );
        $this->assertEquals( $expectedValue, $this->fileSize->getReadableSize() );
    }
}