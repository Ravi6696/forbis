<?php

use Illuminate\Support\Str;

function getResponse($code, $message, $data = null)
{
    return  response()->json([
        'key' => $code,
        'message' => $message,
        'data' => $data
    ]);
}

function generateUniqueId($model, $column)
{
    $id = Str::upper(Str::random(8));
    $data = $model::where($column, $id)->first();
    if ($data) {
        generateUniqueId($model, $column);
    } else {
        return $id;
    }
}