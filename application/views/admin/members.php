<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        All Members
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                <div class="row">
				<div class="col-xs-12">
				<div class="box">
				<div class="box-header">
                              <form action="<?php echo base_url('admin/members/sortby');?>" method="get" class="navbar-form navbar-left" style="margin-right: 19px !important">
                           
                            <div class="form-group">
                                <select name="sort_by" class="form-control">
                                      <option>Sort By</option>
                                      <option value="firstname_asc">Firstname(A-Z)</option>
                                      <option value="firstname_desc">Firstname(Z-A)</option>
                                      <option value="lastname_asc">Lastname(A-Z)</option>
                                      <option value="lastname_desc">Lastname(Z-A)</option>
                                      <option value="memberid_asc">Member ID(Low>High)</option>
                                      <option value="memberid_desc">Member ID(High>Low)</option>
                                </select> 
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>                        

                        <form action="<?php echo base_url('admin/members/search');?>" method="post" class="navbar-form navbar-right" style="margin-right: 19px !important">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
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

						<table  class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Firstname</th>
									<th>Lastname</th>
									<th>Member Id</th>
                                                                     
											
									<th>action</th>
								</tr>
							</thead>
							<tbody>
							<?php if(is_array($result) && count($result))
							 foreach($result as $row){ ?>
								<tr>
									<td><?php echo $row->firstname;?> </td>
									<td><?php echo $row->lastname;?> </td>
									<td><?php echo $row->memberid;?> </td>
                                                                       
									
									<td>
                                                                        <a href="<?php echo base_url('admin/membersview/detail/'.$row->userid);?>" title="View User Detail"><i class="fa fa-eye"></i></a>
									
                                                                     <?php  if ($this->session->userdata('usertype') != 'super-admin') {
                                                                     $this->load->model('admin/admin_model');
                                                                            $settings = $this->admin_model->getAdminsettingsInfoById($this->session->userdata('userid'));
                                                                            foreach ($settings as $value) {
                                                                            if($value['add_edit_member'] == 1){ ?>
                                                                        <a href="<?php echo base_url('admin/membersedit/'.$row->userid);?>" title="Edit User"><i class="fa fa-fw fa-edit"></i></a>
									<a href="<?php echo base_url('admin/membersdelete/delete/'.$row->userid);?>" title="Delete user" onclick="return delete_data();" ><i class="fa fa-fw fa-trash-o"></i></a>
                                                                     <?php } } }else{?>
                                                                        <a href="<?php echo base_url('admin/membersedit/'.$row->userid);?>" title="Edit User"><i class="fa fa-fw fa-edit"></i></a>
									<a href="<?php echo base_url('admin/membersdelete/delete/'.$row->userid);?>" title="Delete user" onclick="return delete_data();" ><i class="fa fa-fw fa-trash-o"></i></a>
                                                                     <?php } ?>  
									</td>

								</tr>
								<?php } ?>
							</tbody>
						</table>
						<div class="row">
                           <div class="col-md-4">
                                <button class="btn btn-primary btn-lg" onclick="goBack()" style="margin:24px 0 !important;">Go Back</button>
                            </div>

                            <div class="col-md-2"></div>

                            <!-- Pagination Small -->                            
                            <div class="col-md-6">
                                <ul class="pagination pagination-sm" style="float:right; margin: 10px 0 !important;">
                                    <?php echo $pagination; ?>
                                </ul>
                            </div>

                        </div>   
					</div><!-- /.box-body -->
                     </div><!-- /.box -->
							
                    </div>   <!-- /.12 -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
</aside><!-- /.right-side -->
<script type="text/javascript">
    function goBack() {
        window.history.back();
    }
</script>
