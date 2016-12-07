<?php

namespace Ambitia\Interfaces\Console;

interface MessageFormatterInterface extends Color
{
    /**
     * @param int $foreground
     * @param int|null $background
     * @return $this
     */
    public function color(int $foreground, int $background = null);

    /**
     * @return $this
     */
    public function bold();

    /**
     * Underline text
     *
     * @return $this
     */
    public function underline();

    /**
     * Dim text
     *
     * @return $this
     */
    public function dim();

    /**
     * Blink text
     *
     * @return $this
     */
    public function blink();

    /**
     * Invert foreground with background colors
     *
     * @return $this
     */
    public function invert();

    /**
     * Get instance of internal library used for CLI
     *
     * @return mixed
     */
    public function getInternalLibrary();
}