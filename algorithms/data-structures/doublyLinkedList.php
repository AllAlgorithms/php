<?php

/**
 * @author Jan Tabacki
 *
 * Implementation of doubly linked list
 * Doubly linked list is a linear data structure
 */

class DoublyLinkedList
{
    private $head;
    private $tail;
    private $length;

    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
        $this->length = 0;
    }

    /**
     * Adding new node as a tail of the linked list
     * @param {any} data This dataue is added at the end of list
     * @returns {DoublyLinkedList} LinkedList after adding new node as tail
     */
    public function push($data)
    {
        $temp = new Node($data);
        if ($this->head == null) {
            $this->head = $temp;
            $this->tail = $temp;
        } else {
            $this->tail->next = $temp;
            $temp->prev = $this->tail;
            $this->tail = $temp;
        }
        $this->length++;
        return $this;
    }

    /**
     * Adding new node as a head of the linked list
     * @param {any} data This dataue is added at the beginning of the list
     * @returns {DoublyLinkedList} LinkedList after adding a new node as head
     */
    public function unshift($data)
    {
        $current = new Node($data);
        if (!$this->head) {
            $this->head = $current;
            $this->tail = $current;
        } else {
            $this->head->prev = $current;
            $current->next = $this->head;
            $this->head = $current;
        }
        $this->length++;
        return $this;
    }

    /**
     * Adding a node to the linkedList at specified position
     * @param {number} index Position at which new node to insert
     * @param {any} data  dataue in the new node
     * @returns {DoublyLinkedList} LinkedList after inserting a new node
     */
    public function insert($index, $data)
    {
        if ($index < 0 || $index > $this->length) {
            throw new Exception('Given index is out of range');
        }
        if ($index === $this->length) {
            return $this->push($data);
        }
        if ($index === 0) {
            return $this->unshift($data);
        }
        $insertNode = new Node($data);
        $previous = $this->get($index - 1);
        $temp = $previous->next;
        $previous->next = $insertNode;
        $insertNode->prev = $previous;
        $insertNode->next = $temp;
        $temp->prev = $insertNode;
        $this->length++;
        return $this;
    }

    /**
     * Removes the node at the end of linked list(tail of linked list)
     * @returns {Node} the node which is going to pop
     */
    public function pop()
    {
        if ($this->head == null) {
            throw new Exception(
                'UNDERFLOW :::: LinkedList is empty, there is nothing to remove'
            );
        }
        $temp = $this->tail;
        if ($this->length == 1) {
            $this->head = null;
            $this->tail = null;
        } else {
            $this->tail = $temp->prev;
            $this->tail->next = null;
            $temp->prev = null;
        }
        $this->length--;
        return $temp->data;
    }

    /**
     * Removes the node from the beginnig of linked list(head of linked list)
     * @returns {Node} the node which is going to shift
     */
    public function shift()
    {
        if ($this->head == null) {
            throw new Exception(
                'UNDERFLOW :::: LinkedList is empty, there is nothing to remove'
            );
        }
        $current = $this->head;
        if ($this->length == 1) {
            $this->head = null;
            $this->tail = null;
        } else {
            $this->head = $current->next;
            $this->head->prev = null;
            $current->next = null;
        }
        $this->length--;
        return $current->data;
    }

    /**
     * Removes a node from the linkedList at specified position
     * @param {number} index
     * @returns {Node} Node which is removed from LinkedList
     */
    public function remove($index)
    {
        if ($index < 0 || $index > $this->length) {
            throw new Exception('Given index is out of range');
        }
        if ($index == $this->length - 1) {
            return $this->pop();
        }
        if ($index == 0) {
            return $this->shift();
        }
        $removeNode = $this->get($index);
        $before = $removeNode->prev;
        $after = $removeNode->next;
        $before->next = $after;
        $after->prev = $before;
        $removeNode->next = null;
        $removeNode->prev = null;
        $this->length--;
        return $removeNode->data;
    }

    /**
     * Retrieve the node at specified index
     * @param {number} index Index of the node
     * @returns {Node} LinkedList Node at specified index
     */
    public function get($index)
    {
        if ($index < 0 || $index >= $this->length) {
            throw new Exception('Given index is out of range');
        }
        if ($index <= $this->length / 2) {
            $counter = 0;
            $current = $this->head;
            while ($counter != $index) {
                $current = $current->next;
                $counter++;
            }
        } else {
            $counter = $this->length - 1;
            $current = $this->tail;
            while ($counter != $index) {
                $current = $current->prev;
                $counter--;
            }
        }
        return $current->data;
    }

    /**
     * Change the data of node at specified index
     * @param {number} index Index of the node
     * @param {any} data data replaces the current data at given index
     * @returns {DoublyLinkedList} LinkedList
     */
    public function set($index, $data)
    {
        $existedNode = $this->get($index);
        if ($existedNode != null) {
            $existedNode->data = $data;
            return $this;
        }
    }

    /**
     * @returns {[]} Linkedlist data as elements in Array
     */
    public function listAsArray()
    {
        $arr = array();
        $current = $this->head;
        while ($current != null) {
            array_push($arr, $current->data);
            $current = $current->next;
        }
        return $arr;
    }

    /**
     * @returns length of the List
     */
    public function length()
    {
        return $this->length;
    }
}

class Node
{
    public $data;
    public $next;
    public $prev;

    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
        $this->prev = null;
    }
}
