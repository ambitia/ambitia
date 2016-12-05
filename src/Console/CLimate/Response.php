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
        $this->climate = new CLImate();
        $this->formatter = $formatter;
    }

    public function output(string $line)
    {
        $this->climate->out($line);
    }

    public function inline(string $string)
    {
        $this->climate->inline($string);
    }

    public function setOutputWriter(string $writer)
    {
        $this->climate->to($writer);
    }

    public function getFormatter(): MessageFormatterInterface
    {
        return $this->formatter;
    }

    public function setFormatter(MessageFormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }
}