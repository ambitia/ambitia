<?php

namespace Ambitia\Interfaces\Console;

interface ResponseInterface
{
    const WRITER_STDOUT = 'out';
    const WRITER_STDERR = 'error';
    const WRITER_BUFFER = 'buffer';

    public function output(string $line);

    public function inline(string $string);

    public function setOutputWriter(string $writer);

    public function getFormatter(): MessageFormatterInterface;

    public function setFormatter(MessageFormatterInterface $formatter);
}