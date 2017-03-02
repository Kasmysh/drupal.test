<div id="shop_goods_spa">
    <div id="goods_filters_block">
        <div class="row">    
            <div class="col-xs-8 col-xs-offset-2">
                <div id="filterContainer" class="input-group">
                    <div class="input-group-btn search-panel">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span id="search_concept">
                                <?= !isset($goodsFilters['currCategory']) ? 'Anything' : $goodsFilters['currCategory']['name'] ?>
                            </span>
                            <span class="caret">
                            </span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php foreach ($goodsCategories as $key => $catItemName): ?>
                                <li><a 
                                        href="#<?= $key ?>" >
                                            <?= $catItemName ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <li class="divider"></li>
                            <li><a href="#">Anything</a></li>
                        </ul>
                    </div>
                    <input type="hidden" name="filters[0][name]" value="category">
                    <input type="hidden" name="filters[1][name]" value="name">
                    <input type="hidden" name="filters[0][value]" id="search_param" 
                            value="<?= !isset($goodsFilters['currCategory']) ? '' : $goodsFilters['currCategory']['value'] ?>"
                        >
                    <input type="text" class="form-control" name="filters[1][value]" placeholder="Searching by good name..." 
                            value="<?= empty($goodsFilters['currGoodName']) ? '' : $goodsFilters['currGoodName'] ?>"
                        >
                    <span class="input-group-btn">
                        <button data-submit="/ajax/shop_goods/goods_change_view" data-submit-container="#filterContainer" data-submit-update="#s_goods" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div id="goodsContantContainer" style="margin-top: 25px;">
        <input type="hidden" name="sortOrders[0][name]" id="orderFildName"
                <?php if (isset($googsSortOrders['currGoodOrder'])) : ?>
                    value="<?= $googsSortOrders['currGoodOrder']['name']?>"
                <?php endif; ?>
            >
        <input type="hidden" name="sortOrders[0][value]" id="orderDirection"
                <?php if (isset($googsSortOrders['currGoodOrder'])) : ?>
                    value="<?= $googsSortOrders['currGoodOrder']['value']?>"
                <?php endif; ?>
            >
        <button class="btn btn-default btn-lg btn-stack" data-submit="/ajax/shop_goods/goods_get_edit_form" data-submit-update=".modal-body"  data-toggle="modal" data-target="#myModal" contenteditable="false">Add good</button>
        <table class="table table-bordered table-striped sort-table">
            <thead>
                <tr>
                    <?php foreach ($goodsTableData['headers'] as $headerSettings): ?>

                        <?php if($headerSettings['isSortable']): ?>
                            <th class="sortable" data-value=<?= $headerSettings['name'] ?> data-submit="/ajax/shop_goods/goods_change_view" data-submit-container="#goodsContantContainer" data-submit-update="#s_goods">
                        <?php else: ?>
                            <th>
                        <?php endif; ?>

                                <?= $headerSettings['name'] ?>
                                <?php if($headerSettings['isSortable']): ?>
                                    <i class="glyphicon glyphicon-sort">
                                    </i>
                                <?php endif; ?>

                            </th>

                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody id="s_goods">
                <?=  $goodsTableData['body'] ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog"  style="margin-top: 10%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>

                    </button>
                        <h4 class="modal-title" id="myModalLabel">Change Goods Set</h4>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

</div> 