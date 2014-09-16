<html>
    <head>
        <?php $this -> load -> view('head'); ?>
    </head>
    <body>
       
        <div id="header">
            <?php
                if(isset($hide_menu)==false){
                    $this -> load -> view('header');
            } ?>
        </div>
        <div id="content_view">
        <div id="side"> <?php $this -> load -> view('side_bar'); ?></div>
        <div id="main"><?php $this -> load -> view($contentView); ?></div>
       
        
        </div>
        <div id="footer">
            <?php $this -> load -> view('footer'); ?>
        </div>
        <?php $this -> load -> view('modals'); ?>
    </body>
</html>
