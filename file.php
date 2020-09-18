<?php

$file = fopen("students.txt", "r");


while(!feof($file)){
  $content = fgets($file);
  echo($content);
}

$file2 = "stdles.txt";



