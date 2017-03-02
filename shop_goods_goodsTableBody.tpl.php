<?php foreach ($goodsTableData['body'] as $row): ?>
    <tr id="good_<?=$row['id']?>">
        <?php foreach ($goodsTableData['headers'] as $headerSettings): ?>
            <td>
                <?php if($headerSettings['name'] == 'edit'): ?>
                        <button class="btn btn-success" data-submit="/ajax/shop_goods/goods_get_edit_form" data-submit-update=".modal-body" data-submit-container="#good_<?=$row['id']?>" data-toggle="modal" data-target="#myModal" contenteditable="false">Edit</button>
                        
                        <button class="btn btn-danger" data-submit="/ajax/shop_goods/goods_del" data-submit-data="id=<?=$row['id']?>" data-submit-update="#s_goods">Del</button>
                <?php else: ?>
                    <input type="hidden" name="<?= $headerSettings['name'] ?>" value="<?= $row[$headerSettings['name']] ?>">
                    <?= $row[$headerSettings['name']] ?>
                <?php endif; ?>
            </td>
        <?php endforeach; ?>
    </tr>
<?php endforeach; ?>