<?php

namespace spec\Ambitia\Validation;

use Ambitia\Contracts\Validation\RuleContract;
use Ambitia\Validation\Exceptions\InvalidRulesFormatException;
use Ambitia\Validation\Rules\Email;
use Ambitia\Validation\Rules\Ip;
use Ambitia\Validation\Rules\Required;
use Ambitia\Validation\Validator;
use PhpSpec\ObjectBehavior;

class ValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith([]);
        $this->shouldHaveType(Validator::class);
        $this->shouldImplement(\Ambitia\Contracts\Validation\Validator::class);
    }

    function it_should_validate_single_field_single_rule()
    {
        $this->beConstructedWith([
            'user' => [
                Required::class
            ]
        ]);
        $this->validate(['user' => 1])->shouldReturn(true);
        $this->result()->shouldReturn([
            'user' => [
                Required::class => true
            ]
        ]);
    }

    function it_should_validate_multiple_fields_multiple_rules()
    {
        $this->beConstructedWith([
            'email' => [
                Required::class,
                Email::class
            ],
            'ip' => [
                Required::class,
                Ip::class
            ]
        ]);
        $this->validate([
            'email' => 'test@example.com',
            'ip' => '127.0.0.1'
        ])->shouldReturn(true);
        $this->result()->shouldReturn([
            'email' => [
                Required::class => true,
                Email::class => true
            ],
            'ip' => [
                Required::class => true,
                Ip::class => true
            ]
        ]);
    }

    function it_should_throw_exceptions_on_invalid_rules_format()
    {
        $this->beConstructedWith(['somestring']);
        $this->shouldThrow(new InvalidRulesFormatException(
            sprintf('Field 0 under validation should have an array of rules')
        ))->duringInstantiation();

        $this->beConstructedWith(['email' => [Validator::class]]);
        $this->shouldThrow(new InvalidRulesFormatException(
            sprintf('Rule class %s does not implement required contract %s',
                Validator::class, RuleContract::class)
        ))->duringInstantiation();
    }

    function it_should_fail_when_rules_are_not_met()
    {
        $this->beConstructedWith([
            'email' => [
                Required::class,
                Email::class
            ],
            'ip' => [
                Required::class,
                Ip::class
            ]
        ]);
        $this->validate([
            'email' => '',
            'ip' => 'awhdoawdoadj'
        ])->shouldReturn(false);
        $this->result()->shouldReturn([
            'email' => [
                Required::class => false,
                Email::class => false
            ],
            'ip' => [
                Required::class => true,
                Ip::class => false
            ]
        ]);
    }

}
