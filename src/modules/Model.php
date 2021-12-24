<?php

namespace LaJoie\modules;
use LaJoie\modules\Connection;

class Model extends Connection
{
    protected static function prepare($sql)
    {
        return Connection::getInstance()->getConnection()->prepare($sql);
    }
}
