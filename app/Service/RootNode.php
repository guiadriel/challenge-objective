<?php
namespace App\Service;

use Illuminate\Support\Str;

class RootNode
{
    private string $question;
    private RootNode $yesNode;
    private RootNode $noNode;
    private RootNode $parentNode;
    private $uuid;
    private bool $nextNode = true;

    public function __construct() {
        $this->uuid = Str::uuid()->toString();
    }

    public function setQuestion( string $question ): self
    {
        $this->question = $question;
        return $this;
    }

    public function getQuestion( string $answer ): string
    {
        return $this->question;
    }

    public function setYesNode( RootNode $node, bool $hasNextNode = false ): self
    {
        $this->yesNode = $node;
        $this->yesNode->setParentNode( $this, $hasNextNode );
        return $this;
    }

    public function setNoNode( RootNode $node, bool $hasNextNode = false ): self
    {
        $this->noNode = $node;
        $this->noNode->setParentNode( $this, $hasNextNode );
        return $this;
    }

    public function getYesNode(): RootNode
    {
        return $this->yesNode;
    }

    public function getNoNode(): RootNode
    {
        return $this->noNode;
    }

    public function setParentNode( RootNode $node, bool $boolNode ): void
    {
        $this->parentNode = $node;
        $this->nextNode = $boolNode;
    }

    public function getParentNode(): RootNode
    {
        return $this->parentNode;
    }

    public function hasNextNode(): bool
    {
        return $this->nextNode;
    }

    public function setNextMode( bool $boolean ): self
    {
        $this->nextNode = $boolean;
        return $this;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getVars()
    {
        return get_object_vars($this);
    }
}
