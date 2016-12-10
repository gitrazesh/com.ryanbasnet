<?php
namespace TYPO3\Flow\Tests\Functional\Reflection\Fixtures;

/*
 * This file is part of the TYPO3.Flow package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use TYPO3\Flow\Reflection\ReflectionService;

/**
 * An annotated class with use statements
 */
class AnnotatedClassWithUseStatements extends AbstractAnnotatedClassWithUseStatements
{
    /**
     * @var ReflectionService
     */
    protected $reflectionService;

    /**
     * @var AnnotatedClass
     */
    protected $annotatedClass;

    /**
     * @var Model\SubEntity
     */
    protected $subEntity;
}
