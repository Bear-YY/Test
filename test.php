<?php
$shot1 = [
  [1,9],
  [2,3],
  [10,0],
  [5,5],
  [1,0],
  [10,0],
  [2,4],
  [3,4],
  [5,2],
  [3,0,0]
];

$shot2 = [
  [10,10],
  [10,10],
  [10,10],
  [10,10],
  [10,10],
  [10,10],
  [10,10],
  [10,10],
  [10,10],
  [10,10,10]
];

$shotcount = [];
$score = 0;
$next = 0;

$shot = $shot2;

for($i = 0; $i < count($shot); $i++) {
  $shotcount[$i] = countTake($shot[$i]);
}

for($i = 0; $i < count($shot); $i++) {
  if($i < 9){
    $score += array_sum($shot[$i]);
    if(checkStrike($shot[$i])){
      $score += array_sum($shot[$i+1]);
      echo $score;
      if($shotcount[$i+1] != 2){
        $score += $shot[$i+2][0];
      }
    }elseif(checkSpare($shot[$i])){
      $score += $shot[$i+1][0];
    }
  }else{
    $score += array_sum($shot[$i]);
  }
  $next = 0;
}

var_dump($shotcount);
echo $score;

function countTake($frame){
  if(count($frame) == 3){
    if(checkSpare($frame) || ($frame[0] + $frame[1] == 20)){
      return 3;
    }else{
      return 2;
    }
  }else{
    if($frame[0] == 10){
      return 1;
    }
    return 2;
  }
}


function checkStrike($frame){
  return $result = ($frame[0] == 10) ? true : false;
}

function checkSpare($frame){
  $result = ($frame[0] + $frame[1] == 10) ? true : false;
  return $result;
}


function judgeFrame($frame){
  if(checkStrike($frame)){
    return 'strike';
  }elseif(checkSpare($frame)){
    return 'spare';
  }
  return 'normal';
}

function br(){
  echo "\n";
}
