<style>
.ord-header,.ord-item {
  display: flex;
}

.ord-header div,.ord-item div{
  width: 14.29%;
  padding: 3px;
  background: #ccc;
  text-align: center;
  color:#000;
}
.ord-list{
  width:100%;
  height:420px;
  overflow:auto;
}
.ord-list div{
  align-items:center;
  background:transparent;
  color:white;
}

</style>
<div class="rb tab" style="width:98%">
  <h2 class="ct">訂票清單</h2>
  <div class="q-del">
    快速刪除:
    <input type="radio" name="type" value="date" checked>依日期
    <input type="date" name="date" id="date">
    <input type="radio" name="type" value="movie">依電影
    <select name="movie" id="movie">
    <?php
    $movies=$Movie->q("select `movie` from `orders` group by `movie`");
    foreach ($movies as $movie ) {

      echo "<option value='{$movie['movie']}'>{$movie['movie']}</option>";
    }
    ?>
    </select>
    <button onclick="qDel()">刪除</button>
  </div>
  <div class="ord-header">
    <div>訂單編號</div>
    <div>電影名稱</div>
    <div>日期</div>
    <div>場次時間</div>
    <div>訂購數量</div>
    <div>訂購位置</div>
    <div>操作</div>
  </div>
  <div class="ord-list">
  <?php
  $orders=$Orders->all(" order by num desc ");
  foreach ($orders as $ord ) {
    
    ?>
    <div class="ord-item">
    <div><?=$ord['num'];?></div>
    <div><?=$ord['movie'];?></div>
    <div><?=$ord['date'];?></div>
    <div><?=$ord['session'];?></div>
    <div><?=$ord['qt'];?></div>
    <div>
    <?php
    $seats=unserialize($ord['seats']);
    foreach($seats as $seat){
      echo (floor($seat/5)+1)."排".($seat%5+1)."號<br>";
    }
    ?>
    </div>
    <div><button onclick="del('orders',<?=$ord['id'];?>)" style="margin:2px;">刪除電影</button></div>
    </div>
    <hr>
  <?php
  }
  ?>
  </div>
</div>
<script>
  function del(table,id){
  $.post('api/del.php',{table,id},function(){
    location.reload();
  })
}
function qDel(){
  let value;
  let type=$("input[type='radio']:checked").val();
  switch(type){
    case "date":
      value=$("#date").val()
    break;
    case "movie":
      value=$("#movie").val()
    break;
  }
  let cfm=confirm('你確定要刪除所有'+value+'的訂單嗎嗎?')
  if(cfm){
    $.post('api/qdel.php',{value,type},function(){
      location.reload();
    })
  }
}
</script>