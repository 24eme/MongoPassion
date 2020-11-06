<?php 
  $output = fopen("php://output",'w') or die("Can't open php://output");
  header("Content-Type:application/csv"); 
  header("Content-Disposition:attachment;filename=$name");
  $fields = array();
  foreach ($docs[0] as $key => $value) {
    array_push($fields, $key);
  }
  fputcsv($output, $fields);
  $content=array();
  foreach ($docs as $entry) {
    foreach ($entry as $key => $value) {
      $content[$key]=$value;
    }
    fputcsv($output, $content);
  }
  fclose($output) or die("Can't close php://output");