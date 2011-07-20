<?php
if(!empty($sections))
{
	foreach($sections as $section => $label)
	{
		if($section == 'loader')
		{
			print('<div class="sections section-'.$section.'">');
			print('<h2>'.$label);
			if(isset($description[$section]))
			{
				print('<span>'.$description[$section].'</span>');
			}
			print('</h2>');
			
			print('<div class="left">');
			
			print('<p>Total files loaded for each category.</p>');
			
			print('<table>');
			
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
			
			print('</table>');
			print('</div>');
			
			
			if(!empty($data[$section]['config']))
			{
				print('<div class="left right sub loader-config">');
				print('<div class="overflow">');
				print('<table>');
				print('<tr>');
				print('<td colspan="3">Loader: <strong>Config</strong> Files</td>');
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
				print('<div class="left right sub loader-library">');
				print('<div class="overflow">');
				print('<table>');
				print('<tr>');
				print('<td colspan="3">Loader: <strong>Libraries</strong> Files</td>');
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
				print('<div class="left right sub loader-helper">');
				print('<div class="overflow">');
				print('<table>');
				print('<tr>');
				print('<td colspan="3">Loader: <strong>Helpers</strong> Files</td>');
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
				print('<div class="left right sub loader-model">');
				print('<div class="overflow">');
				print('<table>');
				print('<tr>');
				print('<td colspan="3">Loader: <strong>Models</strong> Files</td>');
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
	
			print('</div>');
		}
	}
}
?>