
<div class="easyui-layout" data-options="fit:true" id="defhome_layout1">
		<div data-options="region:'center',iconCls:'icon-ok'" title="" >
            <div class="easyui-layout" data-options="fit:true">
				
           
				<div class="easyui-layout" data-options="fit:true" id="defhome_layout2">
					<div data-options="region:'center',iconCls:'icon-ok'" title="" >
						<div class="easyui-layout" data-options="fit:true">
							<table class="easyui-datagrid" id="tableregisterpashome"
							   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="tgl_awal_reg" sortOrder="DESC" >
								<thead>
									<tr>
										<th data-options="field:'newtglnya'" width="30" sortable="true">Tanggal</th>
										<th data-options="field:'no_filemcu'" width="30" sortable="true">No File</th>
										<th data-options="field:'no_reg'" width="30" sortable="true">No Reg</th>
										<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NRP/NIP/NIK</th>
										<th data-options="field:'nm_pas'" width="30" sortable="true">Nama</th>
										<th data-options="field:'alamat_pas'" width="40" sortable="true">Alamat</th>
										<th data-options="field:'no_tlp_pas'" width="20" sortable="true">No.Telp</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					<div data-options="region:'north',iconCls:'icon-ok'" title="" style="height:300px;">
						<div class="easyui-layout" data-options="fit:true">
							<div class="easyui-layout" data-options="fit:true" id="defhome_layout2">
								<div data-options="region:'center',iconCls:'icon-ok'" title="" >
									<div class="easyui-layout" data-options="fit:true">
										<div id="sapi" style="width:100%;height:300px"></div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					
				</div>


		   </div>
        </div>
		<div data-options="region:'west',split:true,iconCls:'icon-home'" title="" style="width:17%;background: url('<?=@base_url('assets/img/pesawat.gif')?>');">
			 <div class="easyui-layout" data-options="fit:true">
					<div class="easyui-layout" data-options="fit:true" id="defhome_layout2">
						<div data-options="region:'north',split:true,iconCls:'icon-home'" title="Dashboard" style="height:170px;background: none;">
							 <div class="easyui-layout" data-options="fit:true">
									<table width="100%">
											<tr>
												<td><div align="center"><img src="<?=@base_url('assets/img/user.png')?>" width="80px" style="margin-top:10px;"/></div></td>
												<td></td>
											</tr>
											<tr>
												<td><div align="center"><span class="text-white"><b style="color:#666666;"><?=ucwords($this->session->userdata('nmlengkap'))?></b></span></div></td>
												<td></td>
											</tr>
										</table>
							 </div>
						</div>
						<div data-options="region:'center',iconCls:'icon-user'" title="Informasi Pengguna" style="overflow:auto;background:#A4C1FD;">
							<div class="easyui-layout" data-options="fit:true">
								<div class="easyui-menu" data-options="inline:true" style="width:100%">
									<div data-options="iconCls:'icon-users'"><?=@$this->session->userdata('nmlengkap')?></div>
									<div class="menu-sep"></div>
									<div data-options="iconCls:'icon-email'"><?=@$this->session->userdata('email')?></div>
									<div class="menu-sep"></div>
									<div data-options="iconCls:'icon-phone'"><?=@$this->session->userdata('no_hp')?></div>
									<div class="menu-sep"></div>
									<div data-options="iconCls:'icon-status'"><span style="padding:5px;background:#224CA0;color:white;border-radius:10px;"><?=@$this->session->userdata('nm_ins')?></span></div>
								</div>
							</div>
						</div>
						
					</div>
	
	
			 </div>
		</div>
    </div>
	
	
	<script>
	
	$('#tableregisterpashome').datagrid({
				url: '<?=@base_url($this->u1.'/jsonhomedata')?>/?filter_tglawal=<?=@date('Y-m-d')?>&filter_tglakhir=<?=@date('Y-m-d')?>&filter_jawatan=&filter_paket=&filter_typejawatan=&filter_keyword=',
			});
	function simpangantipass(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan mengganti password', function(r) {
				if (r){
					$('#formgantipassword').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								$('#passwordlama').val('');
								$('#passwordbaru').val('');
								$('#konfirmasipass').val('');
								$.messager.alert('Informasi', 'Password berhasil dirubah', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
			



				<?php
						$jaran = "select count(a.id_reg) as pitik, DATE_FORMAT(a.tgl_awal_reg, '%j') as bebek, a.tgl_awal_reg, a.cara_bayar from tb_register a where 1=1 and DATE_FORMAT(a.tgl_awal_reg, '%Y%m')='".date('Ym')."' group by cara_bayar, bebek ";
						$kebo = $this->db->query($jaran);
						$srondol = $kebo->result();
						//print_r($srondol);
						foreach($srondol as $curut){
							$loopnamakasir[$curut->cara_bayar] = $curut->cara_bayar;
							$sahudbakpao[$curut->cara_bayar][date('j', strtotime($curut->tgl_awal_reg))][] = $curut->pitik;
						}
						//print_r($srondol);
						$gettgldata = date('j') <= 15 ? range(1, 15) : range(16, 31);
					?>
					$(function () {
						Highcharts.chart('sapi', {
					chart: {
						type: 'area'
					},
					title: {
						text: ''
					},
					subtitle: {
						text: 'Grafik Pendaftaran Pasien '
					},
					xAxis: {
						categories: [
							<?php 
								foreach($gettgldata as $jajan){
									echo ''.$jajan.', ';
								}
							?>
						]
					},
					yAxis: {
						title: {
							text: 'Jumlah Pasien'
						}
					},
					tooltip: {
						crosshairs: true,
						shared: true
					},
					plotOptions: {
						spline: {
							marker: {
								radius: 4,
								lineColor: '#666666',
								lineWidth: 1
							}
						}
					},
					 series: [
					<?php foreach($loopnamakasir as $mei => $jumini){ ?>
					{
						name: '<?=@$jumini?>',
						marker: {
							symbol: 'diamond'
						},
						data: [
						<?php 
								foreach($gettgldata as $jajan){
									$mimi = 0;
									if(is_array($sahudbakpao[$mei][$jajan])){
										$mimi = array_sum($sahudbakpao[$mei][$jajan]);
									}
									echo ''.$mimi.', ';
								}
							?>
						]

					}, 
					<?php } ?>
					]
				});
					});
</script>




