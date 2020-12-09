<?php include("include.php"); ?>
<?php 
$rolesid= $_SESSION['rolesid'];
?>
<body class="bg" onload="graphDisplay('<?php echo $rolesid; ?>')">
<?php include("header.php");?>
<div id="chartcontainer">

	
</div>

<?php include("contextmenu.php"); ?>
<?php include("footer.php"); ?>
</body>
</html>