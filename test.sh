#!/bin/bash

#from="https://www.testddd.com";
from="https://www.testddd.com/";
domain=${from#*//}
echo $domain
domain=${domain%*/}
echo $domain
echo ${from##*/}
echo ${from#*//}
array=(`echo $from | tr '//' ' '` )
echo '0' ${aray[0]}
echo '1' ${array[1]}
echo '2' ${array[2]}
echo '3' ${array[3]}
echo '4' ${array[4]}
echo '4' ${array[5]}
echo '4' ${array[6]}
echo '4' ${array[7]}
echo ${array[@]}
