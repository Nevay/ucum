<?php declare(strict_types=1);
namespace Nevay\Ucum\Internal;

use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
use Antlr\Antlr4\Runtime\Error\Listeners\ANTLRErrorListener;
use Antlr\Antlr4\Runtime\Error\Listeners\BaseErrorListener;
use Antlr\Antlr4\Runtime\Recognizer;
use Nevay\Ucum\UnitException;

final class ErrorListener extends BaseErrorListener implements ANTLRErrorListener {

    public function syntaxError(Recognizer $recognizer, ?object $offendingSymbol, int $line, int $charPositionInLine, string $msg, ?RecognitionException $exception): void {
        throw new UnitException(
            message: $msg,
            previous: $exception,
        );
    }
}
