<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo isset($title) ? $title : $this->lang->line('ebms_home'); ?></title>
        <?php
            echo css_asset('documentation/style.css');
        ?>
    </head>
    <body>
        <h2>User Table Description:</h2>
        <table id="content" cellpadding="0" cellspacing="1" border="0" style="width:100%" class="tableborder">
            <th colspan="18">User Fields</th>
            <tr>
                <td class="td">First Name</td>                    
                <td class="td">Middle Name</td>                    
                <td class="td">Last Name</td>                    
                <td class="td">Address Name</td>                    
                <td class="td">Birth Date</td>                    
                <td class="td">Gender</td>                    
                <td class="td">Status</td>                    
                <td class="td">Home Phone</td>                    
                <td class="td">Work Phone</td>                    
                <td class="td">Date Hired</td>                    
                <td class="td">SSS No.</td>                    
                <td class="td">TIN No.</td>                    
                <td class="td">Phil Health</td>                    
                <td class="td">Pagibig</td>                    
                <td class="td">Salary</td>                    
                <td class="td">Update At</td>                    
                <td class="td">Position Id</td>                    
            </tr>
        </table>
    </body>
</html>