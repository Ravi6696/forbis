<?php

use App\Models\Category;
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

function getJobContractType()
{
    return [
        'CDI' => 'CDI',
        'CSD' => 'CSD',
        'Provider' => 'Provider',
        'Internship' => 'Internship',
        'Alternating' => 'Alternating',
    ];
}

function getJobRythme()
{
    return [
        'face_to_face' => 'Face To Face',
        'partial_teleworking' => 'Partial Teleworking',
        'telecomputing' => 'Telecomputing',
    ];
}