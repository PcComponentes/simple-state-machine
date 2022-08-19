<?php
declare(strict_types=1);

namespace PcComponentes\SimpleStateMachine;

use PcComponentes\Ddd\Domain\Model\ValueObject\StringValueObject;

interface StatusChangeNotAllowedException
{
    public static function from(StringValueObject $id, StringValueObject $currentStatus, StringValueObject $newStatus): self;
}
