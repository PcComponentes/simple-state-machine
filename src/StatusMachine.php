<?php
declare(strict_types=1);

namespace PcComponentes\SimpleStateMachine;

use Pccomponentes\Ddd\Domain\Model\ValueObject\StringValueObject;
use Pccomponentes\Ddd\Domain\Model\ValueObject\Uuid;

trait StatusMachine
{
    private StringValueObject $status;

    abstract public function status(): StringValueObject;

    abstract protected static function allowedStatusChanges(): array;

    abstract protected static function notAllowedStatusChangeExceptionClass(): string;

    final protected function changeStatus(Uuid $id, StringValueObject $newStatus): void
    {
        if (false === $this->canChangeStatus($newStatus)) {
            $class = static::notAllowedStatusChangeExceptionClass();
            $this->assertValidClassException($class);

            throw $class::from($id, $this->status, $newStatus);
        }

        $this->status = $newStatus;
    }

    private function canChangeStatus(StringValueObject $status): bool
    {
        return \in_array(
            $status->value(),
            $this->currentAllowedStatusChanges()
        );
    }

    private function currentAllowedStatusChanges(): array
    {
        return \array_key_exists($this->status()->value(), static::allowedStatusChanges())
            ? static::allowedStatusChanges()[$this->status()->value()]
            : [];
    }

    private function assertValidClassException(string $class): void
    {
        $classReflection = new \ReflectionClass($class);

        if (false === $classReflection->isSubclassOf(StatusChangeNotAllowedException::class)) {
            throw new \InvalidArgumentException(
                \sprintf(
                    'The %s class does not implement the %s interface',
                    $class,
                    StatusChangeNotAllowedException::class
                )
            );
        }
    }
}
