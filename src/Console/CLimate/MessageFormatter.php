<?php namespace Ambitia\Console\CLimate;


use Ambitia\Interfaces\Console\Color;
use Ambitia\Interfaces\Console\MessageFormatterInterface;
use League\CLImate\CLImate;

class MessageFormatter implements MessageFormatterInterface
{

    /**
     * @var CLImate
     */
    protected $climate;

    public function __construct(CLImate $climate)
    {
        $this->climate = $climate;
    }

    /**
     * @inheritDoc
     */
    public function color(int $foreground, int $background = null)
    {
        $foregroundColor = $this->methodForColor($foreground);
        $this->climate->{$foregroundColor}();

        if (!empty($background)) {
            $backgroundColor = $this->methodForColor($background);
            $backgroundColor = sprintf('background%s', ucfirst($backgroundColor));
            $this->climate->{$backgroundColor}();
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function bold()
    {
        $this->climate->bold();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function underline()
    {
        $this->climate->underline();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function dim()
    {
        $this->climate->dim();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function blink()
    {
        $this->climate->blink();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function invert()
    {
        $this->climate->invert();

        return $this;
    }

    /**
     * Get method name to set color in CLImate
     *
     * @param int $colorCode
     * @return int|mixed
     */
    protected function methodForColor(int $colorCode)
    {
        $codes = [
            Color::BLACK => 'black',
            Color::DEFAULT => 'default',
            Color::RED => 'red',
            Color::GREEN => 'green',
            Color::YELLOW => 'yellow',
            Color::BLUE => 'blue',
            Color::MAGENTA => 'magenta',
            Color::CYAN => 'cyan',
            Color::LIGHT_GRAY => 'lightGray',
            Color::DARK_GRAY => 'darkGray',
            Color::LIGHT_RED => 'lightRed',
            Color::LIGHT_GREEN => 'lightGreen',
            Color::LIGHT_YELLOW => 'lightYellow',
            Color::LIGHT_BLUE => 'lightBlue',
            Color::LIGHT_MAGENTA => 'lightMagenta',
            Color::LIGHT_CYAN => 'lightCyan',
            Color::WHITE => 'white'
        ];

        return !empty($codes[$colorCode]) ? $codes[$colorCode] : Color::DEFAULT;
    }

    /**
     * @inheritDoc
     */
    public function getInternalLibrary(): CLImate
    {
        return $this->climate;
    }
}