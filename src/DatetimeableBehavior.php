<?php

/**
 * @author maritechpro
 * @since 2023-06-20
 */

namespace Propel\Generator\Behavior\Datetimeable;
use Propel\Generator\Behavior\Timestampable\TimestampableBehavior;

class DatetimeableBehavior extends TimestampableBehavior
{
    /**
     * @var array<string, mixed>
     */
    protected $parameters = [
        'create_column' => 'created_at',
        'update_column' => 'updated_at',
        'disable_created_at' => 'false',
        'disable_updated_at' => 'false',
        'is_timestamp' => 'false'
    ];

    /**
     * Add the create_column and update_columns to the current table
     *
     * @return void
     */
    public function modifyTable(): void
    {
        $table = $this->getTable();

        if ($this->withCreatedAt() && !$table->hasColumn($this->getParameter('create_column'))) {
            $table->addColumn([
                'name' => $this->getParameter('create_column'),
                'type' => $this->isTimestamp() ? 'TIMESTAMP' : 'DATETIME',
            ]);
        }

        if ($this->withUpdatedAt() && !$table->hasColumn($this->getParameter('update_column'))) {
            $table->addColumn([
                'name' => $this->getParameter('update_column'),
                'type' => $this->isTimestamp() ? 'TIMESTAMP' : 'DATETIME',
            ]);
        }
    }

    /**
     * @return bool
     */
    protected function isTimestamp(): bool
    {
        return $this->booleanValue($this->getParameter('is_timestamp'));
    }
}
