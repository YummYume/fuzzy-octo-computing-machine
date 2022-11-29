<?php

namespace App\Message;

final class EmailNotification
{
    public function __construct(
        public readonly string $content,
        public readonly string $subject,
        public readonly string $to,
        public readonly string $from
    ) {
    }
}
