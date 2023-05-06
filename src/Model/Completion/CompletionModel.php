<?php

namespace RumusBin\OpenAiApiClient\Model\Completion;

use RumusBin\OpenAiApiClient\Model\CreatableFromArray;

class CompletionModel implements CreatableFromArray
{
    private string $id;

    private string $object;

    private string $created;

    private string $model;

    private CompletionChoiceCollection $choices;

    private Usage $usage;

    /**
     * @inheritDoc
     */
    public static function createFromArray(array $data): CreatableFromArray
    {
        $model = new self();
        $model->id = $data['id'];
        $model->object = $data['object'];
        $model->created = $data['created'];
        $model->model = $data['model'];
        $model->choices = CompletionChoiceCollection::createFromArray($data['choices']);
        $model->usage = Usage::createFromArray($data['usage']);

        return $model;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getObject(): string
    {
        return $this->object;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->created;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @return CompletionChoiceCollection
     */
    public function getChoices(): CompletionChoiceCollection
    {
        return $this->choices;
    }

    /**
     * @return Usage
     */
    public function getUsage(): Usage
    {
        return $this->usage;
    }
}
