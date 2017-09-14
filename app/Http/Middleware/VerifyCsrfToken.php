<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'getConfigs',
        'editConfigs',
        'contentState',
        'resourcesUplode',
        'destroy',
        'ban',
        'rolsdestroy',
        'nodestore',
        'smallstata',
        'smallDel',
        'tasksDel',
        'showdel',
        'configdestroy',
        'idcarddestroy',
        'accountdestroy',
        'txtcreate',
    ];
}
