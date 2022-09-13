<?php

use Illuminate\Database\Eloquent\Model;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\TransformerAbstract;

if (!function_exists('wantsJson')) {
    function wantsJson()
    {
        $acceptable = request()->getAcceptableContentTypes();

        return isset($acceptable[0]) && $acceptable[0] == 'application/json';
    }
}

if (!function_exists('itemPresenter')) {
    function itemPresenter(Model $model, TransformerAbstract $transformer)
    {
        $resource = new Item($model, $transformer);
        $fractal = new Manager();

        return $fractal->setSerializer(new ArraySerializer())->createData($resource)->toArray();
    }
}

if (!function_exists('listPresenter')) {
    function listPresenter(\Illuminate\Database\Eloquent\Collection $model, TransformerAbstract $transformer)
    {
        $resource = new \League\Fractal\Resource\Collection($model, $transformer);
        $fractal = new Manager();

        return $fractal->setSerializer(new ArraySerializer())->createData($resource)->toArray();
    }
}
