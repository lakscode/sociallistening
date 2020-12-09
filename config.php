<?php include("include.php"); ?>
<script>
  $(function() {
    $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
  });
  </script>
  <style>
  .ui-tabs-vertical { width: 55em; }
  .ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; border:1px solid #F5467f; }
  .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0;  border:1px solid #F5467f;}
  .ui-tabs-vertical .ui-tabs-nav li a { display:block; }
  .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; }
  .ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 40em;}
  </style>
  <script>
  $(function() {
      var tabs = $( "#tabs" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.fail(function() {
          ui.panel.html(
            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
            "If this wouldn't be a demo." );
        });
      }
    });
	
	  tabs.find( ".ui-tabs-nav" ).sortable({
      axis: "x",
      stop: function() {
        tabs.tabs( "refresh" );
      }
    });
	
  });
  </script>
<body class="bg">
<?php include("header.php");?>

<div id="configContainer" class="customContainer grayLinear">
<div id="subContainer" class="subContainer">
<div style="float:right;">
<!--<input type="submit" value="Save Settings" id="btnClientSave" name="btnClientSave"  /> -->
<input type="button" value="Add Keywords" onclick="javascript:window.location.href='config_persona_add.php';" id="btnClientSave" name="btnClientSave"  />
</div>
<h3>Persona based Keywords Settings</h3>
<div style="clear:both"></div>
<div id="tabs">
  <ul>
  <?php
include("db.php");
$where_clause="";
if($_SESSION['rolesid'] != "")
{
//$where_clause=" where rolesid = " . $_SESSION['rolesid'];
}
$query ="SELECT * FROM roles " . $where_clause;
//echo $query;
$rows=$mysql_conn->query($query);
$competitors="";
?>
<?php
while ($row = $rows->fetch_assoc())
{
  echo '<li><a href="ajax/content1.html">' . $row['rolename'] . '</a></li>';
} 
?>

  </ul>
  <div id="tabs-1">
    <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
  </div>
</div>


</div>
</div>


</body>
</html>