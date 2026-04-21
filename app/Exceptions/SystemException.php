<?php

namespace App\Exceptions;

use Exception;

class SystemException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        logger()->error($this->message, [
            'exception' => $this
        ]
        );
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request)
    {
        return response()->json([
            'message' => $this->getMessage()
        ], 500);
    }
}
