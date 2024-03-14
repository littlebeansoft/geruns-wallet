function show_data(page) {
  /*
    if (page == null) {
      page = $("#page").val();
    } else {
      $("#page").val(page);
    }
    */
    $("#show_data").empty();
    //let param = new FormData(document.getElementById("frm-search"));
    $.post().done(function (data) {
      /*
      obj = jQuery.parseJSON(data);
      $("#show_state").html(obj["pagination"].state);
      pagination(obj["pagination"].max_loop, page);
 
      if (page == 1) {
        x = 1;
      } else {
        x = (page - 1) * $("#qpage").val() + 1;
      }
       */
      da = "";
      da += '<tr class="bgc-h-yellow-l4 d-style">';
      da +=
            '<td class="text-center pr-0 pos-rel center" align="center" >1</td>';
      da += "<td>dsad</td>";
      da += "<td class='text-center' >sdsd</td>";
      da += "</tr>";
      $("#show_data").html(da);
    });
  }


$(function(){
  show_data();
});
