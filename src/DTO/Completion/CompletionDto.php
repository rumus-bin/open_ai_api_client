<?php

namespace RumusBin\OpenAiApiClient\DTO\Completion;

use RumusBin\OpenAiApiClient\Model\Arrayable;

class CompletionDto implements Arrayable
{
    private string $model;
    private string $prompt;
    private ?int $maxTokens = null;
    private ?float $temperature = null;
    private ?int $topP = null;
    private ?int $n = null;
    private ?int $stream = null;
    private ?bool $logProbs = null;

    public function __construct( string $prompt, ?string $model = "text-davinci-003",)
    {
        $this->model = $model;
        $this->prompt = $prompt;
    }

    public function setMaxTokens(?int $maxTokens): self
    {
        $this->maxTokens = $maxTokens;
        return $this;
    }

    public function setTemperature(?float $temperature): self
    {
        $this->temperature = $temperature;
        return $this;
    }

    public function setTopP(?int $topP): self
    {
        $this->topP = $topP;
        return $this;
    }

    public function setN(?int $n): self
    {
        $this->n = $n;
        return $this;
    }

    public function setStream(?int $stream): self
    {
        $this->stream = $stream;
        return $this;
    }

    public function setLogProbs(?bool $logProbs): self
    {
        $this->logProbs = $logProbs;
        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'model' => $this->model,
            'prompt' => $this->prompt
        ];

        $this->logProbs === null ?: $data['logprobs'] = $this->logProbs;
        $this->maxTokens === null ?: $data['max_tokens'] = $this->maxTokens;
        $this->n === null ?: $data['n'] = $this->n;
        $this->stream === null ?: $data['stream'] = $this->stream;
        $this->temperature === null ?: $data['temperature'] = $this->temperature;
        $this->topP === null ?: $data['top_p'] = $this->topP;

        return $data;
    }
}