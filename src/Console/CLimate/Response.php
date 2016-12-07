<?php namespace Ambitia\Console\CLimate;

use Ambitia\Interfaces\Console\MessageFormatterInterface;
use Ambitia\Interfaces\Console\ResponseInterface;
use League\CLImate\CLImate;

class Response implements ResponseInterface
{
    /**
     * @var MessageFormatterInterface
     */
    protected $formatter;

    /**
     * @var CLImate
     */
    protected $climate;

    public function __construct(MessageFormatterInterface $formatter)
    {
        $this->formatter = $formatter;
        $this->climate = $this->formatter->getInternalLibrary();
    }

    /**
     * @inheritDoc
     */
    public function output(string $line)
    {
        $this->climate->out($line);
    }

    /**
     * @inheritDoc
     */
    public function inline(string $string)
    {
        $this->climate->inline($string);
    }

    /**
     * @inheritDoc
     */
    public function setOutputWriter(string $writer)
    {
        $this->climate->to($writer);
    }

    /**
     * @inheritDoc
     */
    public function getFormatter(): MessageFormatterInterface
    {
        return $this->formatter;
    }

    /**
     * @inheritDoc
     */
    public function setFormatter(MessageFormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }
}