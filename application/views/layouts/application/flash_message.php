<div id="flash">
    <div data-content-key = "flash" class = "content">
      <?php
        $success_msg = $this->session->flashdata('success_message');
        $warning_msg = $this->session->flashdata('warning_message');
        
        if(isset($success_message)) { 
            echo '<p class="success">' . $success_message . '</p>';
        } else if (isset($warning_msg) && !empty($warning_msg)) {
            echo '<p class="warning">' . $warning_msg . '</p>';
        } else {
            echo validation_errors('<p class="error">', '</p>');
        }
      ?>
    </div>
</div>