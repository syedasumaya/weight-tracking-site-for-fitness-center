<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        All Admins
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                <div class="row">
				<div class="col-xs-12">
				<div class="box">
				<div class="box-header">
					<h3 class="box-title">Admin Management</h3>                                    
				</div><!-- /.box-header -->	
				<?php 
				if($this->session->flashdata('success')){
				?>
				 <div class="alert alert-success alert-dismissable">
                  <i class="fa fa-check"></i>
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Success!</b> 
					<?php echo $this->session->flashdata('success');?>
                  </div>
				  <?php } ?>
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Username</th>
									<th>Firstname</th>
									<th>Lastname</th>
									<th>Email</th>
                                                                        
									<th>Type</th>	
									<th>action</th>
								</tr>
							</thead>
							<tbody>
							<?php if(is_array($result) && count($result))
							 foreach($result as $row){ ?>
								<tr>
									<td><?php echo $row->username;?> </td>
									<td><?php echo $row->firstname;?> </td>
									<td><?php echo $row->lastname;?> </td>
									<td><?php echo $row->email;?> </td>
									<td><?php echo $row->phone;?> </td>
                                                                       
									<td><?php echo $row->type;?> </td>
                                    <td><a href="<?php echo base_url('admin/members/detail/'.$row->userid);?>" title="View User Detail"><i class="fa fa-eye"></i></a>
									<a href="<?php echo base_url('admin/members/'.$row->userid);?>" title="Edit User"><i class="fa fa-fw fa-edit"></i></a>
									<a href="<?php echo base_url('admin/members/delete/'.$row->userid);?>" title="Delete user" onclick="return delete_data();" ><i class="fa fa-fw fa-trash-o"></i></a>
									</td>

								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div><!-- /.box-body -->
                     </div><!-- /.box -->
							
                    </div>   <!-- /.12 -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
</aside><!-- /.right-side -->

