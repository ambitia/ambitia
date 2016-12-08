<?php namespace Ambitia\Core\Whoops;

use Ambitia\Interfaces\Core\ExceptionHandlerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class ExceptionHandler implements ExceptionHandlerInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var Run
     */
    protected $whoops;

    public function __construct(LoggerInterface $logger)
    {
        $this->whoops = new Run();
        $this->logger = $logger;
    }

    /**
     * Register whoops error handler
     *
     * @param int|array $output
     */
    public function register($output)
    {
        $output = (array) $output;
        foreach ($output as $o) {
            $this->whoops->pushHandler($this->chooseHandler($o));
            $this->whoops->register();
        }
    }

    /**
     * Get output method for exception handler
     *
     * @param int $output
     * @return \Closure|PlainTextHandler|PrettyPageHandler
     */
    protected function chooseHandler(int $output)
    {
        switch ($output) {
            case self::OUTPUT_CONSOLE:
                return new PlainTextHandler();
            case self::OUTPUT_WEB:
                return new PrettyPageHandler();
            case self::OUTPUT_LOGGER:
            default:
                return function (\Exception $exception) {
                    $this->logger->critical($exception->getMessage());
                };
        }
    }
}