<div class="container" id="main-container">
    <div class="row p-3" id="special-scroll">
        <?php
        $div = '';
        if(isset($_SESSION['alert'])){
            $div .= '<div class="col-xs-12 col-md-6 offset-md-3">';
            $div .= '<h5 class="alert alert-'.$_SESSION['alert']['class'].'">'.$_SESSION['alert']['message'].'</h5>';
            $div .= '</div>';
        }
        if (count($data) > 0) {
            $total = 0;
            for ($i=0; $i < count($data); $i++) {
                $total += $data[$i]['price'];
                $div .= '<div class="col-xs-12 col-md-6 offset-md-3 cart-tile mt-3 mb-3 rounded shadow pl-0">';
                $div .= '<img src="./uploads/'.$data[$i]['thumbnail'].'" alt="' . $data[$i]['name'] . '" height="100%" width="85px"/>';
                $div .= '<div class="pl-2">';
                $div .= '<a href="/ecommerce/product/' . $data[$i]['sku'] . '">' . $data[$i]['name'] . '</a>';
                $div .= '<p class="mb-0">R '.number_format($data[$i]['price'],2,'.',',').' '.$data[$i]['unit'].'</p>';
                $div .= '<form method="post" action="">';
                $div .= '<input type="hidden" name="csrf-token" value="'.$_SESSION['csrf']['token'].'" />';
                $div .= '<input type="hidden" name="cart" value="'.$data[$i]['id'].'"/>';
                $div .= '<input type="hidden" name="product" value="'.$data[$i]['sku'].'"/>';
                $div .= '<button class="btn btn-danger p-0 pl-1 pr-1">remove from cart</i></button>';
                $div .= '</form>';
                $div .= '</div>';
                $div .= '</div>';
            }
            $div .= '<div class="col-xs-12 col-md-6 offset-md-3 mb-3"><a href="/checkout" class="btn btn-link btn-outline-primary checkout-btn">Checkout R '.number_format($total,2,'.',',').'</a>';
        } else {
            $div = '<div class="col-xs-12 col-md-6 offset-md-3">';
            $div .= '<h4 class="alert alert-warning text-center">Cart is Empty</h4>';
            $div .= '</div>';
        }
        echo $div;
        ?>
    </div>
</div>