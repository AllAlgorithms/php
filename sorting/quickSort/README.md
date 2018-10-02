# Quick Sort
The basis of quick sort revolves around a pivot element, the initial unsorted dataset will be partionted into three parts:
- The left part (all values that are lower than the current pivot value)
- The pivot value (in this implementation - the first element of the array)
- The right part (all values that are greater than the current pivot value)

After the partition has placed these values in their respective partitioned arrays the algorithm will recursively re-apply the algorithm until all values are sorted.


If you wish to learn more about quick sort there is a brilliant interactive demo that can be found [here](http://me.dt.in.th/page/Quicksort/).

**Basic Example**
```php
$unsorted = [1, 5, 10, 6, 8, 10];
$sorted = quickSort($unsorted);

print_r($sorted); // [1, 5, 6, 8, 10, 10]
```