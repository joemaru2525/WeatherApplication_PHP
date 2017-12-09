<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php
 
  //ライブラリ読込み＆天気予報サイトのhtml取得
  require_once("./phpQuery-onefile.php");
  $html1 = file_get_contents("https://weather.yahoo.co.jp/weather/jp/14/4610.html");
  $doc = phpQuery::newDocument($html1);
  
  $i = 0;
  $announceArr = $doc[".yjw_title_h2.yjw_clr"][".yjSt.yjw_note_h2"];
  $arrayAnnounce = array();
  foreach($announceArr as $val2) {
	$arrayAnnounce[$i] = pq($val2)->text();
	$i++;
  };
  echo "発表日時：　" . $arrayAnnounce[0],"<br><br>";

  $j = 0;
  $dateArr = $doc["div.forecastCity"]["p.date"];
  $arrayDate = array();
  foreach($dateArr as $val3) {
	$arrayDate[$j] = pq($val3)->text();
	$j++;
  }
  echo "対象日付：　",$arrayDate[0],"<br>";

  $k = 0;
  $weatherArr = $doc["div.forecastCity"]["p.pict"];
  $arrayWeather = array();
  foreach($weatherArr as $val4) {
    $arrayWeather[$k] = pq($val4)->text();
	$k++;
  }
  echo "天気予報：　" . "<b><big>",$arrayWeather[0],"</big></b><br><br>";
  
  $k = 0;
  $picArr = $doc["div.forecastCity"]["p.pict"];
  $arrayPic = array();
 foreach($picArr->find('img') as $img){
	$arrayPic[$k] = $img->getAttribute('src');
	//echo $arrayPic[$k],"<br>";
	$k++;
  }
  echo '<img src="',$arrayPic[0],'">';
  echo "<br><br>";
  
  $l = 0;
  $highArr = $doc["div.forecastCity"]["div"]["ul.temp"]["li.high"];
  $arrayHigh = array();
  foreach($highArr as $val5) {
    $arrayHigh[$l] = pq($val5)->text();
	//echo $arrayHigh[$l];
	$l++;
  }
  echo "最高気温：　",$arrayHigh[0],"<br>";
  
  $m = 0;
  $lowArr = $doc["div.forecastCity"]["div"]["ul.temp"]["li.low"];
  $arrayLow = array();
  foreach($lowArr as $val6) {
    $arrayLow[$m] = pq($val6)->text();
	//echo $arrayLow[$m];
	$m++;
  }
  echo "最低気温：　",$arrayLow[0],"<br><br>";
  
  $n = 0;
  $precipArr = $doc["div.forecastCity"]["div"]["tr.precip"]["td"];
  $arrayPrecip = array();
  foreach($precipArr as $val7) {
    $arrayPrecip[$n] = pq($val7)->text();
	//echo $arrayPrecip[$n];
	$n++;
  }
  echo "時間帯　：　0-6・6-12・12-18・18-24<br>";
  echo "降水確率：　",$arrayPrecip[0]," ・ ",$arrayPrecip[1]," ・ ",$arrayPrecip[2]," ・ ",$arrayPrecip[3],"<br>";
  
  echo '<br><br>';
  echo '<small><a href="https://weather.yahoo.co.jp/weather/">Powered by Yahoo! Japan Weather</a></small>';
  
?>
 </body>
</html>