<?php 

namespace ABAPI\Schemes;

use ABAPI\Tools\SchemesConverter;

class ABList extends SchemesConverter
{
    public $name = '';

    public $messages_count_per_account = 0;

    public $messages_delay = 0;

    public $text = '';

    public $deadline = '';
}