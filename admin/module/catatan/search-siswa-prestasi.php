<div class="card-body">
    <h4 class="card-title">Tambah Catatan Prestasi</h4><hr>
    <div class="basic-form">
      <form action="index.php?page=catatan-prestasi-form" method="post" class="form-inline p-3 align-middle">
        <input type="text" name="search" id="search" class="form-control col-md-9 mr-2" placeholder="Masukan nama siswa">
        <input type="submit" name="submit" value="Lanjutkan" class="btn btn-info btn-lg col-md-2">
      </form>
      <div class="col-md-9" style="position: relative;">
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
    url:'./module/catatan/data-siswa.php',
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
    