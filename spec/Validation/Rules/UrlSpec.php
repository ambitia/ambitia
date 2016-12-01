<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;
use Ambitia\Validation\Rules\Url;
use PhpSpec\ObjectBehavior;

class UrlSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Url::class);
        $this->shouldImplement(RuleInterface::class);
    }

    function it_should_pass_on_valid_url()
    {
        $this->validate('http://example.com')->shouldReturn(true);
        $this->validate('ftp://example.com')->shouldReturn(true);
        $this->validate('data://ex4mple.com')->shouldReturn(true);
        $this->validate('mailto://example.com')->shouldReturn(true);
        $this->validate('file://example.com')->shouldReturn(true);
        $this->validate('irc://example.com')->shouldReturn(true);
        $this->validate('https://example.com')->shouldReturn(true);
        $this->validate('http://example.com:90')->shouldReturn(true);
        $this->validate('https://example.com:8080')->shouldReturn(true);
        $this->validate('https://user@example.com:8080')->shouldReturn(true);
        $this->validate('https://user:password@example.com:8080')->shouldReturn(true);
        $this->validate('https://user@example.com:8080#hashtag')->shouldReturn(true);
        $this->validate('https://user@example.com:8080?a=1&b=2')->shouldReturn(true);
        $this->validate('https://user@example.com:8080?a=1;b=2')->shouldReturn(true);
        $this->validate('http://xn--fsqu00a.xn--3lr804guic/')->shouldReturn(true);
        $this->validate('http://example.com/%E5%BC%95%E3%81%8D%E5%89%B2%E3%82%8A.html')->shouldReturn(true);
    }

    function it_should_fail_on_invalid_url()
    {
        $this->validate('//example.com')->shouldReturn(false);
        $this->validate('http/example.com')->shouldReturn(false);
        $this->validate('.')->shouldReturn(false);
    }
}
