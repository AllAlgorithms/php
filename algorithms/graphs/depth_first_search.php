#!/usr/local/bin/php
<?php
/**
 * Depth-First Search algorithm implementation for graph traversal
 * @author Piotr Macha <piotr.macha@owlitdevelopment.com>
 */

/**
 * Simplified GraphNode abstraction
 */
final class GraphNode
{
    /** @var GraphNode[] */
    public $links = [];
    /** @var bool */
    public $visited = false;
}

function depthFirstSearch(GraphNode $startingNode) {
    $startingNode->visited = true;

    foreach ($startingNode->links as $linkedNode) {
        if (!$linkedNode->visited) {
            depthFirstSearch($linkedNode);
        }
    }
}

/**
 * Tests
 */

// Generate random graph with 12 nodes
$nodes = [];
for ($i = 0; $i < 12; ++$i) {
    $nodes[] = new GraphNode();
}

$nodes[0]->links[] = $nodes[1];
$nodes[0]->links[] = $nodes[2];
$nodes[0]->links[] = $nodes[3];

$nodes[1]->links[] = $nodes[4];
$nodes[1]->links[] = $nodes[5];
$nodes[3]->links[] = $nodes[6];
$nodes[3]->links[] = $nodes[7];

$nodes[4]->links[] = $nodes[8];
$nodes[4]->links[] = $nodes[9];
$nodes[6]->links[] = $nodes[10];
$nodes[6]->links[] = $nodes[11];

// Visit graph nodes starting from first node
depthFirstSearch($nodes[0]);

// Check if every node has been visited
foreach ($nodes as $key => $node) {
    if ($node->visited) {
        echo 'Node ' . $key . ' was visited' . PHP_EOL;
    } else {
        echo '[ERROR] Node ' . $key . ' was not visited' . PHP_EOL;
    }
}



