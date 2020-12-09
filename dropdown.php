<style>

a {
    color:#fff;
}
.dropdown dd, .dropdown dt {
    margin:0px;
    padding:0px;
}
.dropdown ul {
    margin: -1px 0 0 0;
}
.dropdown dd {
    position:relative;
}
.dropdown a, 
.dropdown a:visited {
    color:#fff;
    text-decoration:none;
    outline:none;
    font-size: 12px;
}
.dropdown dt a {
    background-color:#4F6877;
    display:block;
    padding: 8px 20px 5px 10px;
    min-height: 25px;
    line-height: 24px;
    overflow: hidden;
    border:0;
    width:272px;
}
.dropdown dt a span, .multiSel span {
    cursor:pointer;
    display:inline-block;
    padding: 0 3px 2px 0;
}
.dropdown dd ul {
    background-color: #4F6877;
    border:0;
    color:#fff;
    display:none;
    left:0px;
    padding: 2px 15px 2px 5px;
    position:absolute;
    top:2px;
    width:280px;	
    list-style:none;
    height: 100px;
    overflow: auto;
}
.dropdown span.value {
    display:none;
}
.dropdown dd ul li a {
    padding:5px;
    display:block;
}
.dropdown dd ul li a:hover {
    background-color:#fff;
}
button {
  background-color: #6BBE92;
  width: 302px;
  border: 0;
  padding: 10px 0;
  margin: 5px 0;
  text-align: center;
  color: #fff;
  font-weight: bold;
}

</style>
<dl id="ddl" class="dropdown"> 
  
    <dt>
    <a href="#">
      <span class="hida">Select</span>    
      <p class="multiSel"></p>  
    </a>
    </dt>
  
    <dd>
        <div id="mutliSelect" class="mutliSelect">
            <ul>
			
<?php
	include("db.php");
		$sql_Competitors ="SELECT brandid, brand FROM brands where active=1 group by brand ";
		//echo $query;
		$competitors="";
		$rows=$mysql_conn->query($sql_Competitors);
		while ($row = $rows->fetch_assoc()){
				echo " <li><input type='checkbox' id='" . $row['brandid'] . "' value='" . $row['brandid'] . "' />" . $row['brand'] . "</li>";
			}
?>

           </ul>
        </div>
    </dd>
</dl>

<script>
$("#ddl dt a").on('click', function () {
          $("#ddl dd ul").slideToggle('fast');
      });

      $("#ddl dd ul li a").on('click', function () {
          $("#ddl dd ul").hide();
      });

      function getSelectedValue(id) {
           return $("#" + id).find("dt a span.value").html();
      }

      $(document).bind('click', function (e) {
          var $clicked = $(e.target);
          if (!$clicked.parents().hasClass("dropdown")) $("#ddl dd ul").hide();
      });

      $('#mutliSelect input[type="checkbox"]').on('click', function () {
	  alert($(this));
        
          var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
              title = $(this).val() + ",";
        
          if ($(this).is(':checked')) {
              var html = '<span title="' + title + '">' + title + '</span>';
              $('.multiSel').append(html);
              $(".hida").hide();
          } 
          else {
              $('span[title="' + title + '"]').remove();
              var ret = $(".hida");
              $('#ddl dt a').append(ret);
              
          }
      });
</script>