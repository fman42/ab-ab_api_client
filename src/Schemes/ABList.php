<?php 

namespace ABAPI\Schemes;

use ABAPI\Tools\SchemesConverter;

class ABList extends SchemesConverter
{
    public string $name = '';

    public int $messages_count_per_account = 0;

    public int $messages_delay = 0;

    public string $text = '';

    public string $deadline = '';
}