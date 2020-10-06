<?php

/**
 * @author Jan Tabacki
 *
 * Implementation of singly linked list
 * Singly linked list is a linear data strucutre
 */

class SinglyLinkedList
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
     * @returns {SinglyLinkedList} LinkedList after adding new node as tail
     */
    public function push($data)
    {
        $temp = new Node($data);
        if ($this->head == null) {
            $this->head = $temp;
            $this->tail = $this->head;
        } else {
            $this->tail->next = $temp;
            $this->tail = $temp;
        }
        $this->length++;
        return $this;
    }

    /**
     * Adding new node as a head of the linked list
     * @param {any} data This dataue is added at the beginning of the list
     * @returns {SinglyLinkedList} LinkedList after adding a new node as head
     */
    public function unshift($data)
    {
        $temp = new Node($data);
        if ($this->head == null) {
            $this->head = $temp;
            $this->tail = $this->head;
        } else {
            $temp->next = $this->head;
            $this->head = $temp;
        }
        $this->length++;
        return $this;
    }

    /**
     * Adding a node to the linkedList at specified position
     * @param {number} index Position at which new node to insert
     * @param {any} data  dataue in the new node
     * @returns {SinglyLinkedList} LinkedList after inserting a new node
     */
    public function insert($index, $data)
    {
        if ($index < 0 || $index > $this->length) {
            throw new Exception('Given index is out of range');
        }
        if ($index == $this->length) {
            return $this->push($data);
        }
        if ($index == 0) {
            return $this->unshift($data);
        }
        $insertNode = new Node($data);
        $previous = $this->get($index - 1);
        $temp = $previous->next;
        $previous->next = $insertNode;
        $insertNode->next = $temp;
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
        $current = $this->head;
        $temp = $current;
        while ($current->next) {
            $temp = $current;
            $current = $current->next;
        }
        $this->tail = $temp;
        $this->tail->next = null;
        $this->length--;
        $this->emptyListCheck();
        return $current->data;
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
        $this->head = $current->next;
        $this->length--;
        $this->emptyListCheck();
        return $current;
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
        $previous = $this->get($index - 1);
        $temp = $previous->next;
        $previous->next = $temp->next;
        $this->length--;
        return $temp;
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
        $counter = 0;
        $current = $this->head;
        while ($counter != $index) {
            $current = $current->next;
            $counter++;
        }
        return $current->data;
    }

    /**
     * Change the data of node at specified index
     * @param {number} index Index of the node
     * @param {any} data data replaces the current data at given index
     * @returns {SinglyLinkedList} LinkedList
     */
    public function set($index, $data)
    {
        // Here error checking will be done by the get method itself
        // No need to specify explicitly
        $existedNode = $this->get($index);
        if ($existedNode) {
            $existedNode->data = $data;
            return $this;
        }
    }

    /**
     * Reversing the Linked list
     * @returns {SinglyLinkedList} LinkedList
     */
    public function reverse()
    {
        $temp = $this->head;
        $this->head = $this->tail;
        $this->tail = $temp;

        $previous = null;
        $after = null;
        while ($temp != null) {
            $after = $temp->next;
            $temp->next = $previous;
            $previous = $temp;
            $temp = $after;
        }
        return $this;
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
     * Utility Function (PRIVATE FUNCTION)
     * if the length is zero then assign null to both head and tail
     */
    private function emptyListCheck()
    {
        if ($this->length == 0) {
            $this->head = null;
            $this->tail = null;
        }
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
    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }
}
