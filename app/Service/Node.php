<?php
namespace App\Service;

use Illuminate\Support\Str;

class Node extends RootNode
{
    private string $dish;

    public function __construct() {
        parent::__construct();
    }

    public function getResolvedQuestion(): string
    {
        $guessedDishQuestion = "O prato que você pensou é {$this->getDish()}?";
        return $guessedDishQuestion;
    }

    public function getQuestion( string $answer ): string
    {
        if( ! $this->hasNextNode() ) {
            return $this->getResolvedQuestion();
        }

        return $this->getResolvedQuestion();
    }

    public function setDish( string $dish ): self
    {
        $this->dish = $dish;
        return $this;
    }

    public function getDish(): string
    {
        return $this->dish;
    }

}
