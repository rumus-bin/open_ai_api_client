<?php

namespace RumusBin\OpenAiApiClient\Model\Completion;

use RumusBin\OpenAiApiClient\Model\AbstractCollection;
use RumusBin\OpenAiApiClient\Model\CreatableFromArray;

class CompletionChoiceCollection extends AbstractCollection implements CreatableFromArray
{
    /**
     * @inheritDoc
     */
    public static function createFromArray(array $data): self
    {
        $items = [];

        foreach ($data as $item) {
            $items[] = CompletionChoiceModel::createFromArray($item);
        }

        $model = new self();
        $model->setItems($items);

        return $model;
    }
}