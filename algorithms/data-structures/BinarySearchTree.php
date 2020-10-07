<?php

/**
 * @author Jan Tabacki
 *
 * Implementation of Binary Search Tree
 * https://en.wikipedia.org/wiki/Binary_search_tree
 */

class BinarySearchTree
{
    private $root;

    public function __construct()
    {
        $this->root = null;
    }

    /**
     * Adding new element to BST 
     * @param {any} Value stored in BST, this must be comparable value because 
     * this implementation does not assume the use of a key
     * @returns {this BST or null} when succesfull add of new element returns this BST otherwise returns null
     */
    public function insert($value)
    {
        $newNode = new Node($value);
        if ($this->root == null) {
            $this->root = $newNode;
            return $this;
        }
        $current = $this->root;
        while (true) {
            if ($value == $current->value) {
                return null;
            }
            if ($value < $current->value) {
                if ($current->left == null) {
                    $current->left = $newNode;
                    return $this;
                }
                $current = $current->left;
            } else {
                if ($current->right == null) {
                    $current->right = $newNode;
                    return $this;
                }
                $current = $current->right;
            }
        }
    }

    /**
     * Deletes given element in BST 
     * @param {any} Value stored in BST 
     */
    public function delete($value)
    {
        if ($this->root == null) {
            return;
        } else {
            $this->findAndDelete($this->root, $value);
        }
    }

    private function minValueNode($node)
    {
        $current = $node;
        while ($current->left != null) {
            $current = $current->left;
        }
        return $current;
    }

    private function findAndDelete($root, $value)
    {
        if ($value < $root->value) {
            $root->left = $this->findAndDelete($root->left, $value);
        } else if ($value > $root->value) {
            $root->right = $this->findAndDelete($root->right, $value);
        } else {
            if ($root->left == null) {
                $temp = $root->right;
                $root = null;
                return $temp;
            } else if ($root->right == null) {
                $temp = $root->left;
                $root = null;
                return $temp;
            }
            $temp = $this->minValueNode($root->right);
            $root->value = $temp->value;
            $root->right = $this->findAndDelete($root->right, $temp->value);
        }
        return $root;
    }

    /**
     * Finding element in BST 
     * @param {any} Value stored in BST
     * @returns {returns found node or null} when succesfull match returns found node otherwise returns null 
     */
    public function find($value)
    {
        if ($this->root == null) {
            return false;
        }
        $current = $this->root;
        $found = false;
        while ($current && !$found) {
            if ($value < $current->value) {
                $current = $current->left;
            } else if ($value > $current->value) {
                $current = $current->right;
            } else {
                $found = true;
            }
        }
        if (!$found) {
            return null;
        }
        return $current;
    }

    /**
     * Check if elements exists in BST 
     * @param {any} Value stored in BST
     * @returns {bool} when succesfull match returns true otherwise returns false 
     */
    public function contains($value)
    {
        if ($this->root == null) {
            return false;
        }
        $current = $this->root;
        $found = false;
        while ($current && !$found) {
            if ($value < $current->value) {
                $current = $current->left;
            } else if ($value > $current->value) {
                $current = $current->right;
            } else {
                return true;
            }
        }
        return false;
    }

    /**
     * BreadthFirstSearch 
     * @returns {array} of BST nodes values
     */
    public function BreadthFirstSearch()
    {
        $node = $this->root;
        $data = array();
        $queue = array();
        array_push($queue, $node);

        while (count($queue)) {
            $node = array_shift($queue);
            array_push($data, $node->value);
            if ($node->left != null) {
                array_push($queue, $node->left);
            }
            if ($node->right != null) {
                array_push($queue, $node->right);
            }
        }

        return $data;
    }

    private function traverseInOrder($node, &$data)
    {
        if ($node->left != null) {
            $this->traverseInOrder($node->left, $data);
        }
        array_push($data, $node->value);
        if ($node->right != null) {
            $this->traverseInOrder($node->right, $data);
        }
    }

    /**
     * DepthFirstSearchInOrder 
     * @returns {array} of ASC orderred BST elements
     */
    public function DepthFirstSearchInOrder()
    {
        $data = array();
        $this->traverseInOrder($this->root, $data);
        return $data;
    }
}

class Node
{
    public $value;
    public $left;
    public $rght;

    public function __construct($value)
    {
        $this->value = $value;
        $this->left = null;
        $this->right = null;
    }
}
