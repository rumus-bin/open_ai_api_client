<?php

namespace RumusBin\OpenAiApiClient\Model\Completion;

use RumusBin\OpenAiApiClient\Model\CreatableFromArray;

class Usage implements CreatableFromArray
{
    private int $promptTokens;

    private int $completionTokens;

    private int $totalTokens;

    /**
     * @inheritDoc
     */
    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->promptTokens = $data['prompt_tokens'];
        $model->completionTokens = $data['completion_tokens'];
        $model->totalTokens = $data['total_tokens'];

        return $model;
    }

    /**
     * @return int
     */
    public function getPromptTokens(): int
    {
        return $this->promptTokens;
    }

    /**
     * @return int
     */
    public function getCompletionTokens(): int
    {
        return $this->completionTokens;
    }

    /**
     * @return int
     */
    public function getTotalTokens(): int
    {
        return $this->totalTokens;
    }
}
