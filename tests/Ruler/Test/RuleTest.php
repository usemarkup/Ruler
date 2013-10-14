<?php

namespace Ruler\Test;

use Ruler\Rule;
use Ruler\Proposition;
use Ruler\Context;
use Ruler\Test\Fixtures\TrueProposition;
use Ruler\Test\Fixtures\CallbackProposition;

class RuleTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $rule = new Rule(new TrueProposition());
        $this->assertInstanceOf('Ruler\Proposition', $rule);
    }

    public function testConstructorEvaluationAndExecution()
    {
        $test           = $this;
        $context        = new Context();
        $executed       = false;
        $actionExecuted = false;

        $ruleOne = new Rule(
            new CallbackProposition(function ($c) use ($test, $context, &$executed, &$actionExecuted) {
                $test->assertSame($c, $context);
                $executed = true;

                return false;
            })
        );

        $this->assertFalse($ruleOne->evaluate($context));

        $executed       = false;
        $actionExecuted = false;

        $ruleTwo = new Rule(
            new CallbackProposition(function ($c) use ($test, $context, &$executed, &$actionExecuted) {
                $test->assertSame($c, $context);
                $executed = true;

                return true;
            }),
            function() use ($test, &$actionExecuted) {
                $actionExecuted = true;
            }
        );

        $this->assertTrue($ruleTwo->evaluate($context));

    }

}
