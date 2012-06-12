<article class="aside-left">
    <div id="clock-cont">
        <div id="analog-clock" >
            <?php
                echo image_asset('clock/clockBg.png', '', array('width'=>'170px', 'height'=>'170px', 'title'=>'EBMS', 'alt'=>'Clock', 'id'=>'bg'));
                echo image_asset('clock/hourHand.png', '', array('id'=>'hourHand'));
                echo image_asset('clock/minuteHand.png', '', array('id'=>'minuteHand'));
                echo image_asset('clock/secondHand.png', '', array('id'=>'secondHand'));
            ?>
        </div>
    </div>
    <?php $this->load->view('dashboard/_summary'); ?>
</article>

<article class="primary">

</article>