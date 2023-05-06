<?php

namespace RumusBin\OpenAiApiClient\Model\Completion;

use RumusBin\OpenAiApiClient\Model\CreatableFromArray;

class CompletionChoiceModel implements CreatableFromArray
{
    private string $text;

    private ?int $logprobs = null;

    private string $finishReason;

    private int $index;


    public static function createFromArray(array $data): CreatableFromArray
    {
        $model = new self();
        $model->text = $data['text'];
        $model->logprobs = $data['logprobs'];
        $model->finishReason = $data['finish_reason'];
        $model->index = $data['index'];

        return $model;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return int|null
     */
    public function getLogprobs(): ?int
    {
        return $this->logprobs;
    }

    /**
     * @return string
     */
    public function getFinishReason(): string
    {
        return $this->finishReason;
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }
}
