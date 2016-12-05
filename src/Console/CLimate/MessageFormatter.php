<?php namespace Ambitia\Console\CLimate;


use Ambitia\Interfaces\Console\MessageFormatterInterface;

class MessageFormatter implements MessageFormatterInterface
{

    public function color(string $foreground, string $background = null)
    {
        // TODO: Implement color() method.
    }

    public function bold(bool $beBold = true)
    {
        // TODO: Implement bold() method.
    }

    public function underline(bool $beUnderlined = true)
    {
        // TODO: Implement underline() method.
    }

    public function dim(bool $beDim = true)
    {
        // TODO: Implement dim() method.
    }

    public function blink(bool $beBlinking = true)
    {
        // TODO: Implement blink() method.
    }

    public function invert(bool $beInverted = true)
    {
        // TODO: Implement invert() method.
    }
}