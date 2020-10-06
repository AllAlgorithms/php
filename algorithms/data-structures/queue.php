<?php

/**
 * @author Jan Tabacki
 *
 * Implementation of Queue Data structure
 * Queue follows FIFO (First In First Out) Principle
 */

class Queue
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
     * Adding data to the end of queue
     * @param {*} data Data to add in the queue
     * @returns {Queue} Returns the queue after adding new data
     */
    public function enqueue($data)
    {
        $newNode = new Node($data);
        if ($this->first == null) {
            $this->first = $newNode;
            $this->last = $newNode;
        } else {
            $this->last->next = $newNode;
            $this->last = $newNode;
        }
        $this->size++;
        return $this;
    }

    /**
     * Removing data from the beginning of the queue
     * @returns Data that is removing from queue
     */
    public function dequeue()
    {
        if ($this->first == null) {
            throw new Exception(
                'UNDERFLOW::: The queue is empty, there is nothing to remove'
            );
        }
        $temp = $this->first;
        if ($this->first === $this->last) {
            $this->last = null;
        }
        $this->first = $this->first->next;
        $this->size--;
        return $temp->data;
    }

    /**
     * @returns First element in the queue
     */
    public function peek()
    {
        if ($this->first == null) {
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
}

class Node
{
    public $data;
    public $next;
    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }
}
