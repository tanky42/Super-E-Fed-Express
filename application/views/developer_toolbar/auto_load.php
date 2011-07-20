<?php
if(!empty($sections))
{
	foreach($sections as $section => $label)
	{
		if($section == 'auto_load')
		{
			print('<div class="sections section-'.$section.'">');
			print('<h2>'.$label);
			if(isset($description[$section]))
			{
				print('<span>'.$description[$section].'</span>');
			}
			print('</h2>');
		
			print('<div class="left">');
			print('<table>');
			
			print('<p>Total files auto-loaded for each category.</p>');
			
			if(!empty($data[$section]['config']))
			{
				print('<tr>');
				print('<td>&raquo; Number of Config Files loaded</td>');
				print('<td> =&gt;</td>');
				print('<td>'.$data[$section]['total_config'].'</td>');
				print('</tr>');
			}
			if(!empty($data[$section]['library']))
			{
				print('<tr>');
				print('<td>&raquo; Number of Libraries loaded</td>');
				print('<td> =&gt;</td>');
				print('<td>'.$data[$section]['total_library'].'</td>');
				print('</tr>');
			}
			if(!empty($data[$section]['helper']))
			{
				print('<tr>');
				print('<td>&raquo; Number of Helpers loaded</td>');
				print('<td> =&gt;</td>');
				print('<td>'.$data[$section]['total_helper'].'</td>');
				print('</tr>');
			}
			if(!empty($data[$section]['model']))
			{
				print('<tr>');
				print('<td>&raquo; Number of Models loaded</td>');
				print('<td> =&gt;</td>');
				print('<td>'.$data[$section]['total_model'].'</td>');
				print('</tr>');
			}
			if(!empty($data[$section]['language']))
			{
				print('<tr>');
				print('<td>&raquo; Number of Languages loaded</td>');
				print('<td> =&gt;</td>');
				print('<td>'.$data[$section]['total_lang'].'</td>');
				print('</tr>');
			}
			
			print('</table>');
			print('</div>');
			
			if(!empty($data[$section]['config']))
			{
				print('<div class="left right sub auto-load-config">');
				print('<div class="overflow">');
				print('<table>');
				print('<tr>');
				print('<td colspan="3">Auto-Load: <strong>Config</strong> Files</td>');
				print('</tr>');
				print('<tr>');
				print('<td colspan="3">&nbsp;</td>');
				print('</tr>');
				foreach($data[$section]['config'] as $record)
				{
					print('<tr>');
					print('<td>&raquo; Config file</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['config'].'</td>');
					print('</tr>');
					print('<tr>');
					print('<td>&raquo; Directory</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['dir'].'</td>');
					print('</tr>');
					print('<tr>');
					print('<td colspan="3">&nbsp;</td>');
					print('</tr>');
				}
				print('</table>');
				print('</div>');
				print('</div>');
			}
			
			if(!empty($data[$section]['library']))
			{
				print('<div class="left right sub auto-load-library">');
				print('<div class="overflow">');
				print('<table>');
				print('<tr>');
				print('<td colspan="3">Auto-Load: <strong>Libraries</strong> Files</td>');
				print('</tr>');
				print('<tr>');
				print('<td colspan="3">&nbsp;</td>');
				print('</tr>');
				foreach($data[$section]['library'] as $record)
				{
					print('<tr>');
					print('<td>&raquo; Library</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['lib'].'</td>');
					print('</tr>');
					print('<tr>');
					print('<td>&raquo; Type</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['type'].'</td>');
					print('</tr>');
					print('<tr>');
					print('<td colspan="3">&nbsp;</td>');
					print('</tr>');
				}
				print('</table>');
				print('</div>');
				print('</div>');
			}
			
			if(!empty($data[$section]['helper']))
			{
				print('<div class="left right sub auto-load-helper">');
				print('<div class="overflow">');
				print('<table>');
				print('<tr>');
				print('<td colspan="3">Auto-Load: <strong>Helpers</strong> Files</td>');
				print('</tr>');
				print('<tr>');
				print('<td colspan="3">&nbsp;</td>');
				print('</tr>');
				foreach($data[$section]['helper'] as $record)
				{
					print('<tr>');
					print('<td>&raquo; Helper</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['helper'].'</td>');
					print('</tr>');
					print('<tr>');
					print('<td>&raquo; Type</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['type'].'</td>');
					print('</tr>');
					print('<tr>');
					print('<td colspan="3">&nbsp;</td>');
					print('</tr>');
				}
				print('</table>');
				print('</div>');
				print('</div>');
			}
			
			if(!empty($data[$section]['model']))
			{
				print('<div class="left right sub auto-load-model">');
				print('<div class="overflow">');
				print('<table>');
				print('<tr>');
				print('<td colspan="3">Auto-Load: <strong>Models</strong> Files</td>');
				print('</tr>');
				print('<tr>');
				print('<td colspan="3">&nbsp;</td>');
				print('</tr>');
				foreach($data[$section]['model'] as $record)
				{
					print('<tr>');
					print('<td>&raquo; Model</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['model'].'</td>');
					print('</tr>');
					print('<tr>');
					print('<td colspan="3">&nbsp;</td>');
					print('</tr>');
				}
				print('</table>');
				print('</div>');
				print('</div>');
			}
			
			if(!empty($data[$section]['language']))
			{
				print('<div class="left right sub auto-load-language">');
				print('<div class="overflow">');
				print('<table>');
				print('<tr>');
				print('<td colspan="3">Auto-Load: <strong>Languages</strong> Files</td>');
				print('</tr>');
				print('<tr>');
				print('<td colspan="3">&nbsp;</td>');
				print('</tr>');
				foreach($data[$section]['language'] as $record)
				{
					print('<tr>');
					print('<td>&raquo; Language</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['lang'].'</td>');
					print('</tr>');
					print('<tr>');
					print('<td colspan="3">&nbsp;</td>');
					print('</tr>');
				}
				print('</table>');
				print('</div>');
				print('</div>');
			}
			
			print('</div>');
		}
	}
}
?>