<?php 
include("db.php");

$data = array();
$index = array();
$query = $mysql_conn->query("SELECT id, parent_id, name FROM categories ORDER BY name");
while ($row = mysql_fetch_assoc($query)) {
    $id = $row["id"];
    $parent_id = $row["parent_id"] === NULL ? "NULL" : $row["parent_id"];
    $data[$id] = $row;
    $index[$parent_id][] = $id;
}
/*
 * Recursive top-down tree traversal example:
 * Indent and print child nodes
 */
function display_child_nodes($parent_id, $level)
{
    global $data, $index;
    $parent_id = $parent_id === NULL ? "NULL" : $parent_id;
    if (isset($index[$parent_id])) {
        foreach ($index[$parent_id] as $id) {
            echo str_repeat("-", $level) . $data[$id]["name"] . "<br>";
            display_child_nodes($id, $level + 1);
        }
    }
}
display_child_nodes(NULL, 0);


/*
 * Recursive bottom-up tree traversal example:
 * Delete child nodes
 */
function delete_child_nodes($parent_id)
{
    global $data, $index;
    $parent_id = $parent_id === NULL ? "NULL" : $parent_id;
    if (isset($index[$parent_id])) {
        foreach ($index[$parent_id] as $id) {
            delete_child_nodes($id);
            echo "DELETE FROM category WHERE id = " . $data[$id]["id"] . "\n";
        }
    }
}
//delete_child_nodes(NULL);

/*
 * Retrieving nodes using variables passed as reference:
 * Get ids of child nodes
 */
function get_child_nodes1($parent_id, &$children)
{
    global $data, $index;
    $parent_id = $parent_id === NULL ? "NULL" : $parent_id;
    if (isset($index[$parent_id])) {
        foreach ($index[$parent_id] as $id) {
            $children[] = $id;
            get_child_nodes1($id, $children);
        }
    }
}
//$children = array();
//get_child_nodes1(5, $children); /* TV and Audio */
//echo implode("\n", $children);



/*
 * Display parent nodes
 */
function display_parent_nodes($id)
{
    global $data;
    $current = $data[$id];
    $parent_id = $current["parent_id"] === NULL ? "NULL" : $current["parent_id"];
    $parents = array();
    while (isset($data[$parent_id])) {
        $current = $data[$parent_id];
        $parent_id = $current["parent_id"] === NULL ? "NULL" : $current["parent_id"];
        $parents[] = $current["name"];
    }
    echo implode(" > ", array_reverse($parents));
}
//display_parent_nodes(24); /* iPad */

?>

