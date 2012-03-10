<article class="primary">
    <section id="employee-list" class="items-list-wrapper">
        <header>
            <h1>
                Employee List
            </h1>
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
                        <a href="#" id="new-employee" data-title="New Employee">
                            <?php echo image_asset('crud_icons/newIcon.png', '', array('alt' => lang('new_employeet'))); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="edit-employee" class="inactive" data-title="Edit Employee">
                            <?php echo image_asset('crud_icons/editIcon.png', '', array('alt' => lang('edit_employee'))); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="delete-employee" class="inactive" data-title="Delete Employee">
                            <?php echo image_asset('crud_icons/deleteIcon.png', '', array('alt' => lang('delete_employee'))); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="restore-employee" class="inactive" data-title="Restore Employee">
                            <?php echo image_asset('crud_icons/restoreIcon.png', '', array('alt' => lang('restore_employee'))); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="transfer-employee" class="inactive" data-title="Transfer  Employee">
                            <?php echo image_asset('crud_icons/transferIcon.png', '', array('alt' => lang('transfer_employee'))); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div id="list" class="list-primary">
                <table id="item-actions-list" class="table-list">
                    <thead>
                        <tr>
                            <th>Employee No.</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($actions) && !empty($actions) && count($actions) > 0) { ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="5">
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


<div id="new-employee-dialog" class="hide" data-ajax-url=<?php echo site_url('employee/get_new_employee_form'); ?>>
    <span class="loader"></span>
</div>

<div id="edit-employee-dialog" class="hide">
    <span class="loader"></span>
</div>

<div id="delete-employee-dialog" class="hide">
    <span class="loader"></span>
</div>

<div id="restore-employee-dialog" class="hide">
    <span class="loader"></span>
</div>

<div id="transfer-employee-dialog" class="hide">
    <span class="loader"></span>
</div>