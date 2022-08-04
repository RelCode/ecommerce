<?php
$records_per_page = 7;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
echo '<nav aria-label="Page Navigation">';
echo "<ul class='pagination'>";
// calculate total pages
$total_pages = ceil($total_rows / $records_per_page);
// button for first page
if ($page > 1 && $total_pages > 2) {
    echo "<li class='page-item'><a href='{$page_url}' class='page-link' title='Go to the first page.'>";
    echo "First";
    echo "</a></li>";
}

// range of links to show
$range = 3;

// display links to 'range of pages' around 'current page'
$initial_num = $page - $range;
$condition_limit_num = ($page + $range)  + 1;

for ($x = $initial_num; $x < $condition_limit_num; $x++) {
    // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
    if (($x > 0) && ($x <= $total_pages)) {

        // current page
        if ($x == $page) {
            echo "<li class='page-item active'><a href=\"#\" class='page-link'>$x <span class=\"sr-only\">(current)</span></a></li>";
        }

        // not current page
        else {
            echo "<li class='page-item'><a href='{$page_url}page=$x' class='page-link'>$x</a></li>";
        }
    }
}

// button for last page
if ($page < $total_pages && $total_pages > 2) {
    echo "<li class='page-item'><a href='" . $page_url . "page={$total_pages}' class='page-link' title='Last page is {$total_pages}.'>";
    echo "Last";
    echo "</a></li>";
}

echo "</ul>";
echo '</nav>';
