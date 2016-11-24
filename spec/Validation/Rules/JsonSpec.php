<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Validation\Rules\Json;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Json::class);
    }

    function it_should_pass_on_valid_json()
    {
        $this->validate('{
            "glossary": {"title": "example glossary","GlossDiv": {"title": "S",
			"GlossList": {"GlossEntry": {"ID": "SGML","SortAs": "SGML",
			"GlossTerm": "Standard Generalized Markup Language",
			"Acronym": "SGML","Abbrev": "ISO 8879:1986","GlossDef": {
            "para": "A meta-markup language, used to create markup languages such as DocBook.",
			"GlossSeeAlso": ["GML", "XML"]
            },"GlossSee": "markup"
            }}}}}')->shouldReturn(true);
    }

    function it_should_fail_on_invalid_json()
    {
        $this->validate('{\'test\': 1, []')->shouldReturn(false);
    }
}
