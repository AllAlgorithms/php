<?php

/**
 * @author Jan Tabacki
 * 
 *
 * Implemtaion of Stack data structure
 * Stack follows LIFO (Last In First Out) priniciple
 * For Insertion and Deletion its complexity is O(1)
 * For Accessing and Searching its complexity is O(n)
 */

class Stack
{
    private $first;
    private $last;
    private $size;

    public function __construct()
    {
        $this->first = null;
        $this->last = null;
        $this->size = 0;
    }

    /**
     * Adding data to Top of the stack
     * @param {*} data
     * @returns {Stack}
     */
    public function push($data)
    {
        $newNode = new Node($data);
        if (!$this->first) {
            $this->first = $newNode;
            $this->last = $newNode;
        } else {
            $temp = $this->first;
            $this->first = $newNode;
            $this->first->next = $temp;
        }
        $this->size++;
        return $this;
    }

    /**
     * Removing data frpm Top of the stack
     * @returns {Node.data} The data that is removing from the stack
     */
    public function pop()
    {
        if (!$this->first) {
            throw new Exception('UNDERFLOW :::: Stack is empty, there is nothing to remove');
        }
        $current = $this->first;
        if ($this->first === $this->last) {
            $this->last = null;
        }
        $this->first = $current->next;
        $this->size--;
        return $current->data;
    }

    /**
     * @returns {Node.data} Top most element of the stack
     */
    public function peek()
    {
        if (!$this->first) {
            throw new Exception('Stack is empty');
        }
        return $this->first->data;
    }

    /**
     * @returns size of the Stack
     */
    public function size()
    {
        return $this->size;
    }

    /**
     * @returns if Stack is empty
     */
    public function isEmpty()
    {
        return $this->size == 0;
    }

    /**
     * clears the Stack
     */
    public function clear()
    {
        $this->first = null;
        $this->last = null;
        $this->size = 0;
    }
}

class Node
{
    public $data;
    public $next;

    function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }
}
