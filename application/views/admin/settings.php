<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		Site Settings
		</h1>
		<ol class="breadcrumb">
			<?php 
			if(isset($breadcumbs)){
				foreach($breadcumbs as $val){
				echo '<li>'.$val.'</li>';
				}
			}
			?>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Site Settings</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
				<?php if($this->session->flashdata('success')){ ?>
				 <div class="alert alert-success alert-dismissable">
                  <i class="fa fa-check"></i>
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Success!</b> 
					<?php echo $this->session->flashdata('success');?>
                  </div>
				  <?php } ?>
					<?php 
					if(validation_errors()){
					?>
				 <div class="alert alert-danger alert-dismissable">
                  <i class="fa fa-ban"></i>
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Error!</b> <?php echo validation_errors();?>
					<?php echo $this->session->flashdata('loginerr');?>
                  </div>
				  <?php } ?>
					<form role="form" action="<?php echo base_url('leads/settings') ?>" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<div class="form-group">
								<label for="name"> Dealer Name</label>
								<input type="text" class="form-control" id="name" name="setting[DealerName]" value="<?php
								if(isset($view->DealerName)!='') echo set_value('setting[DealerName]',$view->DealerName);?>" >
							</div>
							<div class="form-group">
								<label for="name">Address</label>
								<input type="text" class="form-control" id="name" name="setting[Address]" value="<?php
								if(isset($view->Address)!='') echo set_value('setting[Address]',$view->Address);?>" >
							</div>
							<div class="form-group">
								<label for="name">City</label>
								<input type="text" class="form-control" id="name" name="setting[City]" value="<?php
								if(isset($view->City)!='') echo set_value('setting[City]',$view->City);?>" >
							</div>
							<div class="form-group">
								<label for="name">State</label>
								<input type="text" class="form-control" id="name" name="setting[State]" value="<?php
								if(isset($view->State)!='') echo set_value('setting[State]',$view->State);?>" >
							</div>
							<div class="form-group">
								<label for="name">Zip</label>
								<input type="text" class="form-control" id="name" name="setting[Zip]"  value="<?php
								if(isset($view->Zip)!='') echo set_value('setting[Zip]',$view->Zip);?>" >
							</div>
							<div class="form-group">
								<label for="name">Phone</label>
								<input type="text" class="form-control" id="name" name="setting[Phone]" value="<?php
								if(isset($view->Phone)!='') echo set_value('setting[Phone]',$view->Phone);?>" >
							</div>
							<div class="form-group">
								<label for="name">Fax</label>
								<input type="text" class="form-control" id="name" name="setting[Fax]" value="<?php
								if(isset($view->Fax)!='') echo set_value('setting[Fax]',$view->Fax);?>" >
							</div>
							<div class="form-group">
								<label for="name">WebSite</label>
								<input type="text" class="form-control" id="name"  name="setting[WebSite]" value="<?php
								if(isset($view->WebSite)!='') echo set_value('setting[WebSite]',$view->WebSite);?>" >
							</div>
							<div class="form-group">
								<label for="name">Email</label>
								<input type="text" class="form-control" id="name" name="setting[Email]" value="<?php
								if(isset($view->Email)!='') echo set_value('setting[Email]',$view->Email);?>" >
							</div>
							<div class="form-group">
								<label for="name">Used Car Contact</label>
								<input type="text" class="form-control" id="name" name="setting[Contact]" value="<?php
								if(isset($view->Contact)!='') echo set_value('setting[Contact]',$view->Contact);?>" >
							</div>
							<div class="form-group">
								<label for="name">Used Car Contact Phone</label>
								<input type="text" class="form-control" id="name"  name="setting[ContactPhone]" value="<?php
								if(isset($view->ContactPhone)!='') echo set_value('setting[ContactPhone]',$view->ContactPhone);?>" >
							</div>
							<div class="form-group">
								<label for="name">Used Car Contact Email</label>
								<input type="text" class="form-control" id="name" name="setting[ContactEmail]" value="<?php
								if(isset($view->ContactEmail)!='') echo set_value('setting[ContactEmail]',$view->ContactEmail);?>" >
							</div>
							<div class="form-group">
								<label for="name">New Car Contact</label>
								<input type="text" class="form-control" id="name" name="setting[NewCarContact]" value="<?php
								if(isset($view->NewCarContact)!='') echo set_value('setting[NewCarContact]',$view->NewCarContact);?>" >
							</div>
							<div class="form-group">
								<label for="name">New Car Contact phone</label>
								<input type="text" class="form-control" id="name" name="setting[NewContactPhone]" value="<?php
								if(isset($view->NewContactPhone)!='') echo set_value('setting[NewContactPhone]',$view->NewContactPhone);?>" >
							</div>
							<div class="form-group">
								<label for="name">New Car Contact Email</label>
								<input type="text" class="form-control" id="name" name="setting[NewContactEmail]" value="<?php
								if(isset($view->NewContactEmail)!='') echo set_value('setting[NewContactEmail]',$view->NewContactEmail);?>" >
							</div>
							
							<div class="form-group">
								<label for="name">Site Title</label>
								<input type="text" class="form-control" id="name" name="setting[sitetitle]" value="<?php
								if(isset($view->sitetitle)!='') echo set_value('setting[sitetitle]',$view->sitetitle);?>" >
							</div>
							<div class="form-group">
								<label for="name">Site keywords</label>
								<input type="text" class="form-control" id="name" name="setting[sitekeywords]" value="<?php
								if(isset($view->sitekeywords)!='') echo set_value('setting[sitekeywords]',$view->sitekeywords);?>" >
							</div>
							<div class="form-group">
								<label for="name">Site Description</label>
								<input type="text" class="form-control" id="name" name="setting[sitedescription]" value="<?php
								if(isset($view->sitedescription)!='') echo set_value('setting[sitedescription]',$view->sitedescription);?>" >
							</div>
							<div class="form-group">
								<label for="name">Business  Hours</label>
								<textarea  id="editor1" name="setting[businesshours]"  ><?php
								if(isset($view->businesshours)!='') echo set_value('setting[businesshours]',$view->businesshours);?></textarea>
							</div>
							<div class="form-group">
								<label for="name">Add Logos</label>
								<?php if($view->logos){
									echo '<img src="'.base_url('uploads/logo/thumb/'.$view->logos).'">';
								}
								?>
								<input type="file" name="logos" value="<?php echo $view->logos;?>" >
							</div>
							<div class="form-group">
								<label for="name">Guaranteed Logos</label>
								<?php if($view->guaranteed_logos){
									echo '<img src="'.base_url('uploads/logo/'.$view->guaranteed_logos).'" width="35%" height="35%">';
								}
								?>
								<input type="file" name="guaranteed_logos" value="<?php echo $view->guaranteed_logos;?>" >
							</div>
							<div class="form-group">
								<label for="name">Add Slogans</label>
								<input type="text" class="form-control" id="name" name="setting[slogans]" value="<?php
								if(isset($view->slogans)!='') echo set_value('setting[slogans]',$view->slogans);?>" >
							</div>
							<div class="form-group">
								<label for="name">API key</label>
								<input type="text" class="form-control" id="name" name="setting[api_key]" value="<?php
								if(isset($view->api_key)!='') echo set_value('setting[api_key]',$view->api_key);?>" >
							</div>
							<div class="form-group">
								<label for="name">Facebook Link</label>
								<input type="text" class="form-control" id="name" name="setting[fb_link]" value="<?php
								if(isset($view->fb_link)!='') echo set_value('setting[fb_link]',$view->fb_link);?>" >
							</div>
							<div class="form-group">
								<label for="name">Yelp Footer Page Script</label>
								<textarea class="form-control" rows="5" cols="5" name="setting[yelp_footer_script]" > <?php
								if(isset($view->yelp_footer_script)!='') echo set_value('setting[yelp_footer_script]',$view->yelp_footer_script);?></textarea>
							</div>
							<div class="form-group">
								<label for="name">Yelp Details Page Script</label>
								<textarea class="form-control" rows="5" cols="5" name="setting[yelp_details_script]" ><?php
								if(isset($view->yelp_details_script)!='') echo set_value('setting[yelp_details_script]',$view->yelp_details_script);?></textarea>
							</div>
							<div class="form-group">
								<label for="name">Website Footer</label>
								<textarea id="footer" name="setting[footer]" ><?php
								if(isset($view->footer)!='') echo set_value('setting[footer]',$view->footer);?></textarea>
							</div>
							<div class="form-group">
								<label for="name">Disclaimer</label>
								<textarea id="editor" name="setting[disclaimer]" ><?php
								if(isset($view->disclaimer)!='') echo set_value('setting[disclaimer]',$view->disclaimer);?></textarea> 
							</div>
							<div class="form-group">
								<label for="name">Guaranteed Approval Hyper link</label>
								<input type="text" name="setting[guranted_link]" class="form-control" value="<?php
								if(isset($view->guranted_link)!='') echo set_value('setting[guranted_link]',$view->guranted_link);?>" >
							</div>
							<div class="form-group">
								<label for="name">Autoland Logo Hyper link </label>
								<input type="text" name="setting[logo_link]" class="form-control" value="<?php
								if(isset($view->logo_link)!='') echo set_value('setting[logo_link]',$view->logo_link);?>" >
							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>

					</div><!-- /.box-body -->
					</form>
					
				</div><!-- /.box -->
			</div><!--/.col (left) -->
		</div>   <!-- /.row -->
	</section><!-- /.content -->
</aside><!-- /.right-side -->
<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('editor');
                CKEDITOR.replace('editor1');
                CKEDITOR.replace('footer');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
</script>
