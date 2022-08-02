<div class="container" id="main-container">
    <div class="row p-3">
        <div class="col-xs-12 col-md-7" style="height:100%">
            <div id="slideIndicators" class="carousel slide" data-ride="carousel" style="height:100%">
                <ol class="carousel-indicators">
                    <li data-target="#slideIndicators" data-slide-to="0" class="active"></li>
                    <?php
                        $li = '';
                        for ($i=1; $i < count($data['images']); $i++) { 
                            $li .= '<li data-target="#slideIndicators" data-slide-to="'.$i.'"></li>';
                        }
                        echo $li;
                    ?>
                </ol>
                <div class="carousel-inner" style="height:100%">
                    <!-- <div class="carousel-item active"> -->
                    <div class="carousel-item active" style="height: 100%;">
                        <img src="./uploads/<?= $data['images'][0]['path'] ?>" class="d-block w-100" alt="<?= $data['name'] ?>" height="100%" />
                    </div>
                    <?php
                    $div = '';
                    if (count($data['images']) > 1) {
                        for ($i = 1; $i < count($data['images']); $i++) {
                            $div .= '<div class="carousel-item" style="height:100%">';
                            $div .= '<img src="./uploads/' . $data['images'][$i]['path'] . '" class="d-block w-100" height="100%" alt="..." />';
                            $div .= '</div>';
                        }
                    }
                    echo $div;
                    ?>
                    <!-- </div> -->
                    <button class="carousel-control-prev" type="button" data-target="#slideIndicators" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#slideIndicators" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-5">
            <h3><?= $data['name'] ?></h3>
            <h5>R <?= number_format($data['price'], 2, '.', ',') ?></h5>
            <p><?= $data['description'] ?></p>
            <div class="pallettes">
                <strong>Available Colours: </strong>
                <?php
                $col = '';
                $colours = explode(',', $data['available_colours']);
                for ($i = 0; $i < count($colours); $i++) {
                    $col .= '<div class="colour-pallettes ' . strtolower($colours[$i]) . '" title="' . $colours[$i] . '"></div>';
                }
                echo $col;
                ?>
            </div><br>
            <div class="pallettes">
                <strong class="size">Available Sizes: </strong>
                <?php
                $size = '';
                $sizes = explode(',', $data['available_sizes']);
                for ($i = 0; $i < count($sizes); $i++) {
                    $size .= '<div class="size-pallettes">' . $sizes[$i] . '</div>';
                }
                echo $size;
                ?>
            </div>
            <div class="input-group pt-3">
                <select class="form-control" id="size">
                    <option value="">Select Size</option>
                    <?php
                    $selSize = '';
                    for ($i = 0; $i < count($sizes); $i++) {
                        $selSize .= '<option value="' . $sizes[$i] . '">' . $sizes[$i] . '</option>';
                    }
                    echo $selSize;
                    ?>
                </select>
            </div>
            <div class="input-group pt-3">
                <select class="form-control" id="colour">
                    <option value="">Select Colour</option>
                    <?php
                    $selCol = '';
                    for ($i = 0; $i < count($colours); $i++) {
                        $selCol .= '<option value="' . $colours[$i] . '">' . $colours[$i] . '</option>';
                    }
                    echo $selCol;
                    ?>
                </select>
            </div>
            <div class="input-group pt-3">
                <button type="submit" class="btn btn-primary form-control">Add To Cart <i class="fa fa-cart-plus"></i></button>
            </div>
        </div>
    </div>
</div>