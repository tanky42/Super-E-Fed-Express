<ul class="topnav">
	<?php
    if(!empty($sections))
    {
        foreach($sections as $section => $label)
        {
            print('<li>');
            print('<a class="section-link" id="'.$section.'">'.$label.'</a>');
            
            if(isset($data[$section]) && !empty($data[$section]))
            {
                if($section == 'loader')
                {
                    print('<ul class="subnav">');
                    if(!empty($data[$section]['config']))
                    {
                        print('<li><a class="loader sub-link" id="loader-config">Config</a></li>');
                    }
                    if(!empty($data[$section]['library']))
                    {
                        print('<li><a class="loader sub-link" id="loader-library">Libraries</a></li>');
                    }
                    if(!empty($data[$section]['helper']))
                    {
                        print('<li><a class="loader sub-link" id="loader-helper">Helpers</a></li>');
                    }
                    if(!empty($data[$section]['model']))
                    {
                        print('<li><a class="loader sub-link" id="loader-model">Models</a></li>');
                    }
                    print('</ul>');
                }
                
                else if($section == 'auto_load')
                {
                    print('<ul class="subnav">');
                    if(!empty($data[$section]['config']))
                    {
                        print('<li><a class="auto_load sub-link" id="auto-load-config">Config</a></li>');
                    }
                    if(!empty($data[$section]['library']))
                    {
                        print('<li><a class="auto_load sub-link" id="auto-load-library">Libraries</a></li>');
                    }
                    if(!empty($data[$section]['helper']))
                    {
                        print('<li><a class="auto_load sub-link" id="auto-load-helper">Helpers</a></li>');
                    }
                    if(!empty($data[$section]['model']))
                    {
                        print('<li><a class="auto_load sub-link" id="auto-load-model">Models</a></li>');
                    }
                    if(!empty($data[$section]['language']))
                    {
                        print('<li><a class="auto_load sub-link" id="auto-load-language">Languages</a></li>');
                    }
                    print('</ul>');
                }
                else if($section == 'hooks')
                {
                    print('<ul class="subnav">');
                    foreach($data[$section] as $record)
                    {
                        print('<li><a class="hooks sub-link" id="hook-'.$record['point'].'">'.$record['label'].'</a></li>');
                    }
                    print('</ul>');
                }
                else if($section == 'request_data')
                {
                    print('<ul class="subnav">');
                    foreach($data[$section] as $record)
                    {
                        print('<li><a class="request_data sub-link" id="request-data-'.$record['type'].'">'.$record['label'].'</a></li>');
                    }
                    print('</ul>');
                }
				else if($section == 'config')
                {
                    print('<ul class="subnav">');
                    foreach($data[$section] as $record)
                    {
						if(!empty($record['data']))
						{
                        	print('<li><a class="config sub-link" id="config-'.$record['type'].'">'.$record['label'].'</a></li>');
						}
                    }
                    print('</ul>');
                }
            }
            
            print('</li>');
        }
    } else {
        print('<li>&raquo; No debug data - all sections have been disabled.</li>');
    }
    ?>
</ul>