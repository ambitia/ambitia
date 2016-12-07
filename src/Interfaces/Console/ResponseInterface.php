<?php

namespace Ambitia\Interfaces\Console;

interface ResponseInterface
{
    const WRITER_STDOUT = 'out';
    const WRITER_STDERR = 'error';
    const WRITER_BUFFER = 'buffer';

    /**
     * Output string and end the line after that. It will apply Formatter styles.
     * Formatter will reset after the output is printed.
     *
     * @param string $line
     * @return void
     */
    public function output(string $line);

    /**
     * Output string but don't end the line after. It will apply Formatter styles.
     * Formatter will reset after the output is printed.
     *
     * @param string $string
     * @return mixed
     */
    public function inline(string $string);

    /**
     * Choose output writed from self::WRITER_* options. Default is STDOUT.
     *
     * @param string $writer
     * @return void
     */
    public function setOutputWriter(string $writer);

    /**
     * Get the internal Formatter instance to apply extra styling
     *
     * @return MessageFormatterInterface
     */
    public function getFormatter(): MessageFormatterInterface;

    /**
     * Overwrite Formatter instance to reuse styling settings.
     *
     * @param MessageFormatterInterface $formatter
     * @return void
     */
    public function setFormatter(MessageFormatterInterface $formatter);
}