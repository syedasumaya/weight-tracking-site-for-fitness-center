            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        404 Error Page
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
                 
                    <div class="error-page">
                        <h2 class="headline text-info"> 404</h2>
                        <div class="error-content">
                            <h3><i class="fa fa-warning text-yellow"></i> Oops! Access Denied.</h3>
                            <p>
                                We could not find the page you were looking for. 
                                Meanwhile, you may <a href='#'>return to dashboard</a> or try using the search form.
                            </p>
                        </div><!-- /.error-content -->
                    </div><!-- /.error-page -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->