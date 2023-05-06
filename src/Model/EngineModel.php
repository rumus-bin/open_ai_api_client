<?php

namespace RumusBin\OpenAiApiClient\Model;

class EngineModel implements CreatableFromArray
{
    private string $id;
    private string $object;
    private string $created;
    private string $ownedBy;


    public static function createFromArray(array $data): CreatableFromArray
    {
        $model = new self();
        $model->id = $data['id'];
        $model->object = $data['object'];
        $model->created = $data['created'];
        $model->ownedBy = $data['owned_by'];

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getObject(): string
    {
        return $this->object;
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    public function getOwnedBy(): string
    {
        return $this->ownedBy;
    }
}