<?php if(!empty($stylesheets))foreach($stylesheets as $stylesheet){echo $stylesheet;}?>

<script language="javascript">

if (typeof jQuery == 'undefined') {

document.write("<script src='http://code.jquery.com/jquery-latest.min.js'><\/script>");

}
</script>
<?php if(!empty($javascripts))foreach($javascripts as $javascript){echo $javascript;}?>

<!-- Panel -->
<div id="dev_tool">
	<div id="toppanel">
        <div id="panel">
    		<div class="header">
                <h1>Welcome to Developer's Toolbar <span><?php echo $version;?></span></h1>
            	<?php if(isset($menu_view)) echo $menu_view; ?>
            </div>       
            <div class="content clearfix">
            	<?php 
					
					if(!empty($sections))
					{
						foreach($views as $view)
						{
							echo $view;
						}
					}
				?>
            </div>
        </div> <!-- /login -->	

        <!-- The tab on top -->	
        <div class="tab">
            <ul class="login">
                <li class="left">&nbsp;</li>
                <li><?php echo 'CodeIgniter Version '.CI_VERSION; ?></li>
                <li class="sep">|</li>
                <li id="toggle">
                    <a id="open" class="open" href="#">Open Developer's Toolbar</a>
                    <a id="close" style="display: none;" class="close" href="#">Close Developer's Toolbar</a>			
                </li>
                <li class="right">&nbsp;</li>
            </ul> 
        </div> <!-- / top -->
        
    </div> <!--panel -->
</div>