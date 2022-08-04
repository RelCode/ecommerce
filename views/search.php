<div class="container" id="main-container">
    <div class="row p-3" id="special-scroll">
        <?php
        $div = '';
        // if (isset($_SESSION['alert'])) {
            $div .= '<div class="col-xs-12 col-md-6 offset-md-3">';
            $div .= '<h5 class="alert alert-info"> Search Results: ' . ucwords($_GET['query']) . '</h5>';
            $div .= '</div>';
        // }
        if ($data['count'] > 0) {
            $total = 0;
            for ($i = 0; $i < count($data) - 1; $i++) {
                $total += $data[$i]['price'];
                $div .= '<div class="col-xs-12 col-md-6 offset-md-3 cart-tile mt-3 mb-3 rounded shadow pl-0">';
                $div .= '<img src="./uploads/' . $data[$i]['thumbnail'] . '" alt="' . $data[$i]['name'] . '" height="100%" width="85px"/>';
                $div .= '<div class="pl-2">';
                $div .= '<a href="/product/' . $data[$i]['sku'] . '">' . $data[$i]['name'] . '</a>';
                $div .= '<p class="mb-0">R ' . number_format($data[$i]['price'], 2, '.', ',') . ' ' . $data[$i]['unit'] . '</p>';
                $div .= '</div>';
                $div .= '</div>';
            }
        } else {
            $div = '<div class="col-xs-12 col-md-6 offset-md-3">';
            $div .= '<h4 class="alert alert-warning text-center">'.$_SESSION['alert']['message'].'</h4>';
            $div .= '</div>';
        }
        echo $div;
        echo '<div class="col-xs-12 col-md-6 offset-md-3">';
        $page_url = '/ecommerce/search?string=' . $_GET['query'] . '&';
        $total_rows = $data['count'];
        include_once './views/layouts/pagination.php';
        echo '</div>';
        ?>
        </div>
    <!-- </div> -->
</div>