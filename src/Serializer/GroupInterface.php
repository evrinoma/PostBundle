<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\PostBundle\Serializer;

interface GroupInterface
{
    public const API_POST_POST = 'API_POST_POST';
    public const API_PUT_POST = 'API_PUT_POST';
    public const API_GET_POST = 'API_GET_POST';
    public const API_CRITERIA_POST = self::API_GET_POST;
    public const APP_GET_BASIC_POST = 'APP_GET_BASIC_POST';
}
