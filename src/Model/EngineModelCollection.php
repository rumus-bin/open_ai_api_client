<?php

namespace RumusBin\OpenAiApiClient\Model;

class EngineModelCollection extends AbstractCollection implements CreatableFromArray
{
    public static function createFromArray(array $data): self
    {
        $data = $data['data'];
        $items = [];

        foreach ($data as $item) {
            $items[] = EngineModel::createFromArray($item);
        }

        $model = new self();
        $model->setItems($items);

        return $model;
    }
}