<!--<article class="aside-left">
</article>

<article class="primary">
</article>-->

<article class="primary">
    <section id="products-list-wrapper" class="items-list-wrapper">
        <header>
            <h1>
                Products List
            </h1>            
            <div id="search">
                <input type="text" id="search-input" />
                <button type="button" id="go">search</button>
            </div>
        </header>
        <div class="nav-list">
            <a>
                <img src />
            </a>
        </div>
        <div id="list">            
                <table id="product-list" class="items-list">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Unit Price</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Sub Category</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($actions) && !empty($actions) && count($actions) > 0) { ?>
                            <?php foreach ($actions as $action) { ?>
                                <tr>
                                    <td><?php echo $action->username; ?></td>
                                    <td><?php echo $action->details; ?></td>
                                    <td><?php echo $action->date_created; ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="8">
                                    <h3>No data found.</h3>
                                </td>
                            </tr>                            
                        <?php } ?>
                        <?php // echo $pagination_links; ?>            
                    </tbody>
                </table>                        
        </div>
    </section>
</article>