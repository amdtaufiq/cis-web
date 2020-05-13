<div class="card-body">
    <div class="basic-form">
      <form action="index.php?page=catatan-prestasi-form" method="post" class="form-inline p-3">
        <input type="text" name="search" id="search" class="form-control form-control-lg rounded-0 border-info" placeholder="Search..." style="width:80%;">
        <input type="submit" name="submit" value="Search" class="btn btn-info btn-lg rounded-0" style="width:20%;">
      </form>
      <div class="col-md-5" style="position: relative;margin-top: -38px;margin-left: 215px;">
        <div class="list-group" id="show-list">
        
        </div>
      </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.js"></script>
<script>
$(document).ready(function(){
$("#search").keyup(function(){
let searchText = $(this).val();
if(searchText != ''){
  $.ajax({
    url:'action-catatan.php',
    method:'post',
    data:{query:searchText},
    success:function(response){
      $("#show-list").html(response);
    }
  });
}
else{
  $("#show-list").html('');
}
});
$(document).on('click','a', function(){
$("#search").val($(this).text());
$("#show-list").html('');
});
});
</script>    
    