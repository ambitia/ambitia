<?php namespace Ambitia\Validation\Exceptions;

use Exception;

class InvalidRulesFormatException extends \Exception
{
    /**
     * This exception is thrown when the format of validation rules passed to the
     * instance of validator is incorrect. Example valid format:
     * [
     *      'user_logo' => [
     *          Ambitia\Validation\Rules\Required::class,
     *          Ambitia\Validation\Rules\MimeType::class => 'image/png'
     *      ],
     *      'date' => [
     *          Ambitia\Validation\Rules\Date::class => 'd/m/Y'
     *      ]
     * ]
     * @inheritDoc
     */
    public function __construct($message, Exception $previous = null)
    {
        parent::__construct($message, 500, $previous);
    }

}