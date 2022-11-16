$(document).ready(function () {
  $(".del_btn").on('click', function(){
    var rtn_val = confirm("정말 삭제하시겠습니까?");
    var ldg_idx = $('#ldg_idx').val();
    if(rtn_val == true){
      location.href = "ldg_delete.php?ldg_idx="+ldg_idx;
    };
  });
});