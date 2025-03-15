<table id="wedusbalapdua" class="easyui-datagrid" style="width:auto;height:auto;" data-options="singleSelect:true,fit:true,rownumbers:true,fitColumns:true">
        <thead>
            <tr>
                <th field="name1" width="30">Kode</th>
                <th field="name2" width="50">Pemeriksaan</th>
                <th field="name3" width="70">Set Header Pemeriksaan</th>
                <th field="name4" width="100">Detail List Pemeriksan</th>
                <th field="name5" width="20"></th>
            </tr>                          
        </thead>                           
        <tbody>                            
			<?php
					$sm = " select * from tb_tindakan, tb_grouptind ";
					$sm .= " where tb_tindakan.kd_grouptind = tb_grouptind.kd_grouptindakan ";
					$sm .= " and tb_grouptind.id_grouptindakan='". $this->uri->segment(3) ."' ";
					$sm .= " order by tb_tindakan.nm_tind ASC ";
					$an = $this->db->query($sm);
					$query = $an->result();
					$sss = 1;
					foreach($query as $sk){
						$ssd = $sss++;
				?>  
				<tr>
					<td><?=@$sk->kd_tind?></td>
					<td><?=@$sk->nm_tind?></td>
					<td><input type="text" id="setheaderaplikasi<?=@$sk->id_tind?>" onchange="setheadertind('<?=@$sk->id_tind?>')" value="<?=@$sk->header_app_tind?>"></td>
					<td>
						<?php
							//$this->db->where('id_pem', $h->id_pem);
							$this->db->where('id_tind', $sk->id_tind);
							$dao = $this->db->get('tb_pemeriksaan_meta');
							$srt = $dao->result();
							if($srt){
								foreach($srt as $dtu){
									$mm = $this->madmin->get_value('id_pem', $dtu->id_pem, 'tb_pemeriksaan');
									$dsa[$sk->id_tind][] = $mm[0]->nm_pem;
								}
								echo implode(", ", $dsa[$sk->id_tind]);
							}
							$ddss = '<a href="javascript:void(0)" iconCls="icon-edit" class="easyui-linkbutton" onclick="tampiljenispemeriksaan(\''. $sk->id_tind .'\', \''.$sk->nm_tind.'\')"></a>';
							if($sk->id_tind == $this->madmin->Get_setting('lab_gas_darah_tind_id') OR $sk->id_tind == $this->madmin->Get_setting('lab_darah_tepi_tind_id')){
								$ddss = '-';
							}
						?>
					</td>
					<td><?=@$ddss?></td>
				</tr>
				<?php } ?>
        </tbody>                           
    </table>
	
	<div id="modaldetailtindakandua" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false" footer="#modaldetailtindakandua_toolbar" collapsible="false" class="easyui-window" title="" style="width:700px;height:500px;padding:5px;background:#ffffff;">
    </div>
	<div id="modaldetailtindakandua_toolbar" style="padding:4px;">
			<div style="text-align:right;">
				<a href="javascript:void(0)" class="easyui-linkbutton" onclick="simpanperubahandetailpemeriksaan()"><b>Simpan Perubahan</b></a>
			</div>
		</div>
	<script type="text/javascript">
	function setheadertind(id){
		var dd  = $('#setheaderaplikasi'+id).val();
		//alert(dd);
		$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpansetheadertind')?>", {
			val:dd, id: id,
		}, function(response){	
				//alert(response);
		});
	}
	function tampiljenispemeriksaan(id, nm){
                $('#modaldetailtindakandua').window('open');
				$('#modaldetailtindakandua').panel({
					title: 'Detail Pemeriksaan - '+nm,
					href:'<?=@base_url($this->u1.'/ajaxloadbukadetailpemeriksaan/'. $this->uri->segment(3))?>/'+id,
				});
		}
	function simpanperubahandetailpemeriksaan(){
		$('#formdetailtambahajaxpem').form('submit',{  
                success:function(data){  
					if(data == 'Insert' || data == 'Update'){
						//setTimeout(function(){ $('#modalpekerjaan').modal('hide'); $("#modalpekerjaan").form('clear'); window.location=location.href;}, 1000);
						  $('#modaldetailtindakandua').window('close');
						  var bbb = $('#newtabketerangan').tabs('getSelected');
							bbb.panel('refresh', '<?=@base_url($this->u1.'/ajaxkonfigurasipemeriksaanlab/'. $this->uri->segment(3))?>');
					}
					else {
						$.messager.alert('Informasi', data, 'info');
					}
				}  
            }); 	
	}
	</script>