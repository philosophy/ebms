<article class="primary">
    <section id="product-asset-list" class="items-list-wrapper">
        <header>
            <h1>
                Product/Asset List
            </h1>
            <div id="list-options-wrapper">
                <select name="list_options" id="list-options">
                    <option value="products">Products</option>
                    <option value="assets">Assets</option>
                </select>
            </div>
            <div class="right-options">
                <div id="search">
                    <input type="text" id="search-input" />
                    <button type="button" id="go">search</button>
                </div>
                <div id="print-report">
                    <?php echo image_asset('icons/pdf-icon.png', '', array('alt' => lang('report'))); ?>
                </div>
            </div>
        </header>
        <article class="container">
            <div class="items-nav">
                <ul>
                    <li>
                        <a href="#" id="new-product" data-title="New Product">
                            <?php echo image_asset('crud_icons/newIcon.png', '', array('alt' => lang('new_product'))); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="edit-product" class="inactive" data-title="Edit Product">
                            <?php echo image_asset('crud_icons/editIcon.png', '', array('alt' => lang('edit_product'))); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="delete-product" class="inactive" data-title="Delete Product">
                            <?php echo image_asset('crud_icons/deleteIcon.png', '', array('alt' => lang('delete_product'))); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="restore-product" class="inactive" data-title="Restore Product">
                            <?php echo image_asset('crud_icons/restoreIcon.png', '', array('alt' => lang('restore_product'))); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="transfer-product" class="inactive" data-title="Transfer  Product">
                            <?php echo image_asset('crud_icons/transferIcon.png', '', array('alt' => lang('transfer_product'))); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div id="list" class="list-primary">
                <table id="item-actions-list" class="table-list">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Brand</th>
                            <th>Unit Price</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($actions) && !empty($actions) && count($actions) > 0) { ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7">
                                    <h3>No data found.</h3>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php// echo $pagination_links; ?>
            </div>
        </article>

    </section>
</article>


<div id="new-product-wrapper" class="hide" data-ajax-url=<?php echo site_url('inventory/items/get_new_item_form'); ?>>
    <span class="loader"></span>
</div>

<div id="edit-product-wrapper" class="hide">
    <span class="loader"></span>
</div>

<div id="delete-product-wrapper" class="hide">
    <span class="loader"></span>
</div>

<div id="restore-product-wrapper" class="hide">
    <span class="loader"></span>
</div>

<div id="transfer-product-wrapper" class="hide">
    <span class="loader"></span>
</div>