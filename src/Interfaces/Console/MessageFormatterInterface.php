<?php

namespace Ambitia\Interfaces\Console;

interface MessageFormatterInterface
{
    public function color(string $foreground, string $background = null);

    public function bold(bool $beBold = true);

    public function underline(bool $beUnderlined = true);

    public function dim(bool $beDim = true);

    public function blink(bool $beBlinking = true);

    public function invert(bool $beInverted = true);
}