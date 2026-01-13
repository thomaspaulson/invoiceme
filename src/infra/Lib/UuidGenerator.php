<?php
namespace Infra\Lib;

use Illuminate\Support\Str;

trait UuidGenerator {

    function uuid(): string
    {
        return Str::uuid();
    }

}
