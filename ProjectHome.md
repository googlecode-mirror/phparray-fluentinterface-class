  * ...
  * 
  * allow array to be treated in this way：
  * $testArr1 = array(0,1,2,3,4,5);
  * $testArr2 = array(10,11,12,13,14,15);
  * A::extend($testArr1, $testArr2);
  * 
  * $testArr1 -> array\_push('extended!') -> array\_3rd\_compact() -> array\_merge($testArr2);
  * var\_dump($testArr1 -> myArray);
  * 
  * ...
  * 
  * all php bulit-in array functions are implemented, and some are given more control options for further flexibility.