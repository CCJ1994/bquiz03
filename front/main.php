  <div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
      <div id="abgne-block-20111227">
        <ul class="lists">
        </ul>
        <ul class="controls">
        </ul>
      </div>
    </div>
  </div>
  <div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;display:flex;flex-wrap:wrap;">
      <?php
        $movies=$Movie->all(['sh'=>1],'order by rank');

        foreach($movies as $movie){
          $date=strtotime($movie['year']."-".$movie['month']."-".$movie['day']);
          $today=strtotime(date("Y-m-d"));

          if($date<=$today && $date>=strtotime('-2 days',$date)){
            ?>
      <div style="width:48%;margin:3px;border:1px solid #fff;">
        <div style="text-align:center;">片名:<?=$movie['name'];?></div>
        <div style="display:flex;align-items:center;">
          <a href="javascript:location.href='index.php?do=intro&id=<?=$movie['id'];?>'"><img src="img/<?=$movie['poster'];?>" style="width:80px;height:100px;"></a>
          <div style="margin-left:5px;">
            分級:<img style="width:20px;" src="icon/<?=$movie['level'];?>.png" alt=""><?=$movie['level'];?><br>
            上映日期:<br><?=$movie['year']."-".$movie['month']."-".$movie['day'];?>
          </div>
        </div>
        <div style="text-align:center;margin:5px">
          <button onclick="javascript:location.href='index.php?do=intro&id=<?=$movie['id'];?>'">劇情簡介</button>
          <button onclick="javascript:location.href='index.php?do=order&id=<?=$movie['id'];?>'">線上訂票</button>
        </div>
      </div>
      <?php
          }

        }
        
        ?>
      <div class="ct"> </div>
    </div>
  </div>
  </div>