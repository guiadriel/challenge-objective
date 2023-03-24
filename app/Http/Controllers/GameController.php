<?php
namespace App\Http\Controllers;

use App\Service\Node;
use App\Service\RootNode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public function __construct() { }

    private function setupGame( Request $request ): RootNode
    {
        $yesNode = (new Node())->setDish('Lasanha');
        $noNode = (new Node())->setDish('Bolo de Chocolate');

        $rootNode = (new RootNode())
            ->setQuestion('O prato que você pensou é Massa?')
            ->setYesNode($yesNode)
            ->setNoNode($noNode);

        // Persist the game state in the session to be used in the next request
        $request->session()->put('game', $rootNode);
        $request->session()->forget('currentNode');
        return $rootNode;
    }

    public function play( Request $request )
    {
        if ( ! $request->session()->has('game') ) {
            $rootNode = $this->setupGame( $request );
        }
        $rootNode = $request->session()->get('game');
        $request->session()->forget('currentNode');
        $request->session()->put('questions', []);

        return view('game', [
            'question' => $rootNode->getQuestion( 'yes' ),
        ]);
    }

    public function nextQuestion( Request $request )
    {
        $rootNode = $request->session()->get('game');
        $currentNode = $request->session()->get('currentNode') ?? $rootNode;

        $questions = $request->session()->get('questions');
        $questions[] = Str::ucfirst($request->input('answer'));
        $request->session()->put('questions', $questions);

        if( $request->input('answer') === 'yes' ) {
            if( ! $currentNode->hasNextNode() ) {
                return view('gameover', [
                    'response' => 'Acertei de novo!',
                    'ask' => false
                ]);
            }

            $nextNode = $currentNode->getYesNode();
            $request->session()->put('currentNode', $nextNode );

            return view('game', [
                'question' => $nextNode->getQuestion( 'yes' ),
            ]);
        }

        if( $request->input('answer') === 'no' ) {
            if( ! $currentNode->hasNextNode() ) {
                return view('gameover', [
                    'ask' => true,
                ]);
            }

            $nextNode = $currentNode->getNoNode();
            $request->session()->put('currentNode', $nextNode );

            return view('game', [
                'question' => $nextNode->getQuestion( 'yes' ),
            ]);

        }
        $request->session()->put('currentNode', $currentNode->getNoNode() );
        return view('game', [
            'question' => $currentNode->getNoNode()->getQuestion( '' ),
        ]);
    }

    public function addDish( Request $request )
    {
        $currentNode = $request->session()->get('currentNode');
        return view( 'compare', [
            'dish' => $request->input('dish'),
            'currentDish' => $currentNode->getDish(),
        ] );
    }

    public function compare( Request $request )
    {
        $gameNodes = $request->session()->get('game');
        $questions = $request->session()->get('questions');
        $currentNode = $request->session()->get('currentNode');
        $newNode = (new RootNode())
            ->setQuestion("O prato que você pensou é {$request->input('category')}?")
            ->setYesNode((new Node())->setDish($request->input('dish')))
            ->setNoNode($currentNode)
            ->setNextMode( true );

        $nodeToUpdate = $gameNodes;
        $nodes = [ $gameNodes ];

        foreach( $questions as $key =>$question ) {
            if ( $key < count($questions) - 1 ) {
                $getPossibleNode = "get{$question}Node";
                $nodes[] = $nodeToUpdate->{$getPossibleNode}();
                $nodeToUpdate = $nodeToUpdate->{$getPossibleNode}();
            }
        }

        array_pop( $nodes );
        array_pop( $questions );
        $nodes = array_reverse( $nodes );
        $questions = array_reverse( $questions );

        foreach( $nodes as $key => &$node ) {
            $setPossibleNode = "set{$questions[$key]}Node";
            if(  $questions[$key] === 'Yes' || count($questions) === 1 ) {
                $node = $node->{$setPossibleNode}( $newNode, true );
            }

            if (count(array_flip($questions)) === 1 && end($questions) === 'No') {
                if ( $key === 0 )  {
                    $node = $node->{$setPossibleNode}( $newNode, true );
                }
            }
        }

        $gameNodes = array_pop( $nodes );
        $request->session()->flush();
        $request->session()->put('game', $gameNodes);

        return redirect()->route('play');
    }

    public function clean( Request $request )
    {
        $request->session()->flush();
        return redirect()->route('play');
    }
}
