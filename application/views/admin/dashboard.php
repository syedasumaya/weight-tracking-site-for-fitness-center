<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
    </section>
   
    <style>
        .my-box{
            padding-left:20px;
            padding-right:20px;
            padding-bottom:20px;
        }
    </style>
    <!-- Main content Accessible-->
    <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <div class="box my-box"><?php //print_r($profile);  ?>
                    <h3>Profile</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>   
                                <th>User Name</th> 
                                <th>Admin Type</th>   
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $profile->firstname; ?></td>
                                <td><?php echo $profile->lastname; ?></td>
                                <td><?php echo $profile->username; ?></td>
                                <td><?php echo $profile->type; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.box -->
            </div>   <!-- /.12 -->
        </div>   <!-- /.row -->
        <div class="row">
            <div class="col-xs-6">
                <div class="box my-box"><?php //print_r($profile);  ?>
                 <h3>Total Admin of this site</h3>
                 <p style="font-size : 16px;">Total Admin : <?php echo count($admin);?></p>
                 <h3>Total Member of this site</h3>
                 <p style="font-size : 16px;">Total Member : <?php echo $member;?></p>
                 <h3>Total Location of this site</h3>
                 <p style="font-size : 16px;">Total Location : <?php echo $location;?></p>
                </div><!-- /.box -->
            </div>   <!-- /.12 -->
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<script type="text/javascript">
    function goBack() {
        window.history.back();
    }
</script>
