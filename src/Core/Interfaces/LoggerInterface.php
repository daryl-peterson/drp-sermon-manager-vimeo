<?php

namespace DRPSMVimeo\Core\Interfaces;

/**
 * Interface description.
 *
 * @category
 *
 * @author      Daryl Peterson <@gmail.com>
 * @copyright   Copyright (c) 2024, Daryl Peterson
 * @license     https://www.gnu.org/licenses/gpl-3.0.txt
 *
 * @since       1.0.0
 */
interface LoggerInterface
{
    /**
     * Log debug message.
     */
    public static function debug(mixed $context): bool;

    /**
     * Log error message.
     */
    public static function error(mixed $context): bool;

    /**
     * Log info message.
     */
    public static function info(mixed $context): bool;
}
