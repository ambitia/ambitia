<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Validation\Rules\MimeType;
use PhpSpec\ObjectBehavior;

class MimeTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('image/png');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(MimeType::class);
    }

    function it_should_pass_on_valid_png_file()
    {
        $this->validate(__DIR__ . '/../../data/test.png')->shouldReturn(true);
        $this->validate(__DIR__ . '/../../data/test.jpg')->shouldReturn(false);
    }

    function it_should_pass_on_valid_jpg_files()
    {
        $this->beConstructedWith('image/jpeg');
        $this->validate(__DIR__ . '/../../data/test.jpg')->shouldReturn(true);
        $this->validate(__DIR__ . '/../../data/test.jpeg')->shouldReturn(true);
        $this->validate(__DIR__ . '/../../data/test.png')->shouldReturn(false);
    }

    function it_should_pass_on_valid_gif_file()
    {
        $this->beConstructedWith('image/gif');
        $this->validate(__DIR__ . '/../../data/test.gif')->shouldReturn(true);
        $this->validate(__DIR__ . '/../../data/test.xcf')->shouldReturn(false);
        $this->validate(__DIR__ . '/../../data/test.png')->shouldReturn(false);
    }

}
