<?php
declare(strict_types=1);

namespace PcComponentes\SimpleStateMachine;

use Pccomponentes\Ddd\Domain\Model\ValueObject\StringValueObject;
use Pccomponentes\Ddd\Domain\Model\ValueObject\Uuid;

interface StatusChangeNotAllowedException
{
    public static function from(
        Uuid $id,
        StringValueObject $currentStatus,
        StringValueObject $newStatus
    ): self;
}
