<?php

declare(strict_types=1);

class ArguementsException extends Exception {

    public function __construct(?string $message,
                                int $code = 0,
                                ?Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function getErrorMessage():string {
        return "Invalid Arguement(s): " . $this->getMessage();
    }

}
