<?php

namespace Traits;

// This trait is used for formatting JSON responses
trait ResponseFormatter {
    public function responseFormatter($code, $message, $data = null) {
        return json_encode([
            "code" => $code,
            "message" => $message,
            "data" => $data
        ]);
    }
}
?>