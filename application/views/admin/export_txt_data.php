<aside class="right-side">
<?php
/*$file = base_url()."/exportfile/inventory.txt";
$homepage = file_get_contents($file);
echo $homepage;*/
$file = base_url()."/exportfile/".$file_name;
$fh = fopen($file,'r');
while(! feof($fh))
  {
  echo fgets($fh). "<br /><br />";
  }

fclose($fh);
?>
</aside>