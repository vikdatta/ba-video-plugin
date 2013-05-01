<?php
if (!class_exists('WP_List_Table')) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class My_List_Table extends WP_List_Table {

    function get_columns() {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'ID' => 'Id',
            'thumb' => 'Thumb',
            'post_title' => 'Title',
            //'guid' => 'Link',
            'status' => 'Status',
            'author' => 'Author',
            'duration' => 'Duration'
        );
        return $columns;
    }

    function get_bulk_actions() {
        $actions = array(
            'delete' => 'delete'
        );
        return $actions;
    }

    function __construct() {
        parent::__construct(array(
            'singular' => 'video ', //Singular label
            'plural' => 'videos', //plural label
            'ajax' => true //We won't support Ajax for this table
        ));
    }

    function process_bulk_action() {

        if ('delete' === $this->current_action()) {

            foreach ($_POST['video'] as $video) {

                //echo $video;
                wp_delete_post($video, TRUE);
            }
        }
    }

    function prepare_items($a) {


        //$this->search_box('search', 'search_id'); 
        $this->process_bulk_action();
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = array($columns, $hidden, $sortable);

        // $this->items = $a;

        usort($a, array(&$this, 'usort_reorder'));
//$this->items = $a;
        $per_page = 10;
        $current_page = $this->get_pagenum();
        $total_items = count($a);

        $this->found_data = array_slice($a, (($current_page - 1) * $per_page), $per_page);
        $this->set_pagination_args(array(
            'total_items' => $total_items, //WE have to calculate the total number of items
            'per_page' => $per_page //WE have to determine how many items to show on a page
        ));
        $this->items = $this->found_data;
        global $query_string;

        $query_args = explode("&", $query_string);
        $search_query = array();

        foreach ($query_args as $key => $string) {
            $query_split = explode("=", $string);
            $search_query[$query_split[0]] = urldecode($query_split[1]);
        } // foreach

        $search = new WP_Query($search_query);

        // print_r($_POST); 
    }

    function column_default($item, $column_name) {
        switch ($column_name) {
            case 'ID':
            case 'thumb':
            case 'post_title':
            //case 'guid':
            case 'status':
            case 'author':
            case 'duration':
                return $item[$column_name];
            default:
                return print_r($item, true); //Show the whole array for troubleshooting purposes
        }
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'ID' => array('ID', false),
            'thumb' => array('thumb', false),
            'post_title' => array('post_title', false),
            //'guid' => array('guid', false),
            'status' => array('status', false),
            'author' => array('author', false),
            'duration' => array('duration', false)
        );
        return $sortable_columns;
    }

    function usort_reorder($a, $b) {
        // If no sort, default to title
        $orderby = (!empty($_GET['orderby']) ) ? $_GET['orderby'] : 'ID';
        // If no order, default to asc
        $order = (!empty($_GET['order']) ) ? $_GET['order'] : 'dsc';
        // Determine sort order
        $result = strcmp($a[$orderby], $b[$orderby]);
        // Send final sort direction to usort
        return ( $order === 'asc' ) ? $result : -$result;
    }

    function column_post_title($item) {

        $actions = array(
            'edit' => sprintf('<a href="?page=Video&mode=%s&id=%s">Edit</a>', 'edit', $item['ID']),
            'delete' => sprintf('<a href="?page=Video&mode=%s&id=%s">Delete</a>', 'del', $item['ID']),
        );
        return sprintf('%1$s %2$s', $item['post_title'], $this->row_actions($actions));
    }

    function column_cb($item) {
        return sprintf(
                        '<input type="checkbox" name="%1$s[]" value="%2$s" />', $this->_args['singular'], $item['ID']
        );
    }

}
?>
<div class="icon32" id="icon-edit">
</div>
<?php
$myListTable = new My_List_Table();
echo '<div class="wrap"><h2>VIDEO LIST <a href="admin.php?page=ba-submit"><input type="submit" name="show_add" value="Add Video »" class="button-primary"></a></h2><br />';
?>

<?php
$myListTable->prepare_items($this->a);
?><form method="post">

    <input type="hidden" name="page" value="my_list_test" />

<?php $myListTable->search_box('search', 'search_id'); ?>

    <?php $myListTable->display(); ?>
</form><?php
    echo '</div>';
    ?>
    
