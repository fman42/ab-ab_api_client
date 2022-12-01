<?php 

namespace ABAPI\Schemes;

use ABAPI\Tools\SchemesConverter;

class ABList extends SchemesConverter
{
    /**
     * @var string $name
     */
    public $name = '';

    /**
     * @var int $name
     */
    public $messages_count_per_account = 0;

    /**
     * @var int $name
     */
    public $messages_delay = 0;

    /**
     * @var string $name
     */
    public $text = '';

    /**
     * @var string $name
     */
    public $deadline = '';
}