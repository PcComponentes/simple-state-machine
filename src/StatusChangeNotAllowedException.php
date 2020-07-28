<?php
declare(strict_types=1);

namespace PcComponentes\SimpleStateMachine;

use PcComponentes\Ddd\Domain\Model\ValueObject\StringValueObject;
use PcComponentes\Ddd\Domain\Model\ValueObject\Uuid;

interface StatusChangeNotAllowedException
{
    public static function from(Uuid $id, StringValueObject $currentStatus, StringValueObject $newStatus): self;
}
