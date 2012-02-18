<!--<article class="aside-left">
</article>

<article class="primary">
</article>-->

<article class="primary">
    <section id="audit-trail">
        <header>
            <h1>
                Audit Trail
            </h1>
            <div id="range">
                <label class="datepickerLabel">From</label>
                <input type="text" id="from" class="datepickerInput hasDatepicker">
                <label class="datepickerLabel">To</label>
                <input type="text" id="to" class="datepickerInput hasDatepicker">
                <button type="button" id="go">Go</button>
            </div>
            <div id="search">
                <input type="text" id="search-input" />
                <button type="button" id="go">search</button>
            </div>
        </header>
        
        <div id="list">
            <?php if (isset($actions) && !empty($actions) && count($actions) > 0) { ?>
                <table id="user-actions-list">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Details</th>
                            <th>Action Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($actions as $action) { ?>
                            <tr>
                                <td><?php echo $action->username; ?></td>
                                <td><?php echo $action->details; ?></td>
                                <td><?php echo $action->date_created; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <h3>No data found.</h3>
            <?php } ?>
            <?php echo $pagination_links; ?>            
        </div>
    </section>
</article>