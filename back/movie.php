<div class="rb tab" style="width:98%">
  <button onclick="javascript:location.href='backend.php?do=add_movie'">新增電影</button>
  <hr>
  <div style="max-height:450px;overflow-y:auto;">
    <?php 
    $movies=$Movie->all("order by rank");
    foreach($movies as $key=>$movie){
      ?>
    <div style="background:white;color:black;display:flex;margin:1px 0;">
      <div style="width:10%;margin:auto 2px;">
        <img src="img/<?=$movie['poster'];?>" style="width:80px;">
      </div>
      <div style="width:10%;margin:auto;">
        分級:<img src="icon/<?=$movie['level'];?>.png" style="width:25px;vertical-align:middle;">
      </div>
      <div style="width:80%;">
        <div style="display:flex;text-align:center;">
          <div style="width:33%;">片名:<?=$movie['name'];?></div>
          <div style="width:33%;">片長:<?=$movie['length'];?></div>
          <div style="width:33%;">上映時間:<?=$movie['year'];?>-<?=$movie['month'];?>-<?=$movie['day'];?></div>
        </div>
        <div style="text-align:right;margin:5px;">
        <button onclick="display('movie',<?=$movie['id'];?>)"><?=($movie['sh'])?'顯示':'隱藏';?></button>
        <?php
          if($key!=0){
            ?>
            <button onclick="sw(<?=$movie['id'];?>,<?=$movies[$key-1]['id'];?>)">往上</button>
          <?php
          }
          ?>
          <?php
          if($key!=count($movies)-1){
            ?>
          <button onclick="sw(<?=$movie['id'];?>,<?=$movies[$key+1]['id'];?>)">往下</button>
            <?php
          }
          ?>
          <button onclick="javascript:location.href='backend.php?do=edit_movie&id=<?=$movie['id'];?>'" style="margin:2px;">編輯電影</button>
          <button onclick="del('movie',<?=$movie['id'];?>)" style="margin:2px;">刪除電影</button>
        </div>
        <div style="margin:5px;"><?=$movie['intro'];?></div>
      </div>
    </div>
    <?php 
    }
    ?>
  </div>

</div>

<script>

function sw(idx, idy) {
  $.post('api/sw.php', {table: 'movie',idx,idy}, function() {
    location.reload();
  })
}

function del(table,id){
  $.post('api/del.php',{table,id},function(){
    location.reload();
  })
}

function display(table,id){
  $.post('api/display.php',{table,id},function(){
    location.reload();
  })
}

</script>