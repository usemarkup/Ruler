<?php

/*
 * This file is part of the Ruler package, an OpenSky project.
 *
 * (c) 2011 OpenSky Project Inc
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ruler;

use Ruler\Proposition;
use Ruler\Context;

/**
 * Rule class.
 *
 * A Rule is a conditional Proposition
 *
 * @author Justin Hileman <justin@shopopensky.com>
 * @implements Proposition
 */
class Rule implements Proposition
{
    protected $condition;
    protected $action;

    /**
     * Rule constructor.
     *
     * @param Proposition $condition Propositional condition for this Rule
     */
    public function __construct(Proposition $condition)
    {
        $this->condition = $condition;
    }

    /**
     * Evaluate the Rule with the given Context.
     *
     * @param Context $context Context with which to evaluate this Rule
     *
     * @return boolean
     */
    public function evaluate(Context $context)
    {
        return $this->condition->evaluate($context);
    }

}
