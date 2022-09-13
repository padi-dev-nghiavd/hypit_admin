<?php
namespace Infrastructure;


class CustomException extends \Exception
{
    private $options;

    public function __construct($message = "", $code = 0, \Throwable $previous = null, array $options = [])
    {
        parent::__construct($message, $code, $previous);
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }
}
