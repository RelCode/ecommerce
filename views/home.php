<div class="container" id="main-container">
    <div class="row p-3">
        <?php
            if(count($data) > 0){
                $div = '';
                for ($i=0; $i < count($data); $i++) { 
                    $div .= '<div class="col-xs-12 col-md-3 mb-4 product-tile">';
                    $div .= '<a href="product/'.$data[$i]['sku'].'">';
                    $div .= '<div class="card">';
                    $div .= '<img class="card-img-top" src="./uploads/'.$data[$i]['thumbnail'].'" alt="'.$data[$i]['name'].'" height="285px"/>';
                    $div .= '<div class="card-body">';
                    $div .= '<h5 class="card-title product-name">'.$data[$i]['name'].'</h5>';
                    $div .= '<p class="card-text">R '.number_format($data[$i]['price'],2,'.',',').' per '.$data[$i]['unit'].'</p>';
                    $div .= '</div>';
                    $div .= '</div>';
                    $div .= '</a>';
                    $div .= '</div>';
                }
                echo $div;
            }
        ?>
    </div>
</div>