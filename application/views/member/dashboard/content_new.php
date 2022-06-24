<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try {
                    ace.settings.check('breadcrumbs', 'fixed')
                } catch (e) {
                }
            </script>

            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>
                <li class="active">Dashboard</li>
            </ul><!-- /.breadcrumb -->

            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off">
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>

        <div class="page-content">
            <div class="ace-settings-container" id="ace-settings-container">
                <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                    <i class="ace-icon fa fa-cog bigger-130"></i>
                </div>

                <div class="ace-settings-box clearfix" id="ace-settings-box">
                    <div class="pull-left width-50">
                        <div class="ace-settings-item">
                            <div class="pull-left">
                                <select id="skin-colorpicker" class="hide">
                                    <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                    <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                    <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                    <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                </select><div class="dropdown dropdown-colorpicker">		<a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="btn-colorpicker" style="background-color:#438EB9"></span></a><ul class="dropdown-menu dropdown-caret"><li><a class="colorpick-btn selected" href="#" style="background-color:#438EB9;" data-color="#438EB9"></a></li><li><a class="colorpick-btn" href="#" style="background-color:#222A2D;" data-color="#222A2D"></a></li><li><a class="colorpick-btn" href="#" style="background-color:#C6487E;" data-color="#C6487E"></a></li><li><a class="colorpick-btn" href="#" style="background-color:#D0D0D0;" data-color="#D0D0D0"></a></li></ul></div>
                            </div>
                            <span>&nbsp; Choose Skin</span>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar">
                            <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar">
                            <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs">
                            <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl">
                            <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container">
                            <label class="lbl" for="ace-settings-add-container">
                                Inside
                                <b>.container</b>
                            </label>
                        </div>
                    </div><!-- /.pull-left -->

                    <div class="pull-left width-50">
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover">
                            <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact">
                            <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight">
                            <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                        </div>
                    </div><!-- /.pull-left -->
                </div><!-- /.ace-settings-box -->
            </div><!-- /.ace-settings-container -->

            <div class="page-header">
                <h1>
                    Dashboard
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        overview &amp; stats
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="alert alert-block alert-warning">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                        </button>

                        <i class="ace-icon fa fa-check green"></i>

                        Welcome to
                        <strong class="green">
                            MrIklan

                        </strong>,
                        The Largest Ads Network
                    </div>

                    <div class="row">
                        <div class="space-6"></div>

                        <div class="col-sm-7 infobox-container">
                            <div class="infobox infobox-blue" onclick="klikMenu('<?php echo base_url('member/editprofile/changePassword') ?>')">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-wrench"></i>
                                </div>

                                <div class="infobox-data">
                                    <span class="infobox-data-number">Password</span>
                                    <div class="infobox-content">Change your password</div>
                                </div>


                            </div>

                            <div class="infobox infobox-blue" onclick="klikMenu('<?php echo base_url('member/network/daftar') ?>')">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-users"></i>
                                </div>

                                <div class="infobox-data">
                                    <span class="infobox-data-number">Users</span>
                                    <div class="infobox-content">Users on your network</div>
                                </div>


                            </div>

                            <div class="infobox infobox-blue" onclick="klikMenu('<?php echo base_url('member/network/tree') ?>')">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-tree"></i>
                                </div>

                                <div class="infobox-data">
                                    <span class="infobox-data-number">Network Tree</span>
                                    <div class="infobox-content">See users as tree</div>
                                </div>


                            </div>

                            <div class="infobox infobox-blue" onclick="klikMenu('<?php echo base_url('member/network/unilevel') ?>')">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-list-ul"></i>
                                </div>

                                <div class="infobox-data">
                                    <span class="infobox-data-number">Unilevel</span>
                                    <div class="infobox-content">See users as unilevel</div>
                                </div>


                            </div>

                            <div class="infobox infobox-blue" onclick="klikMenu('<?php echo base_url('member/ewallet/summary') ?>')">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-dollar "></i>
                                </div>

                                <div class="infobox-data">
                                    <span class="infobox-data-number">Wallet</span>
                                    <div class="infobox-content">Manage your wallet</div>
                                </div>


                            </div> 

                            <div class="infobox infobox-blue">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-calculator"></i> 
                                </div>

                                <div class="infobox-data">
                                    <span class="infobox-data-number">Withdrawal</span>
                                    <div class="infobox-content">See your withdrawal</div>
                                </div>


                            </div>

                            <div class="space-6"></div>
                            <div class="infobox infobox-green infobox-small infobox-dark">
                                <div class="infobox-progress">
                                    <!-- #section:pages/dashboard.infobox.easypiechart -->
                                        <div class="easy-pie-chart percentage" data-percent="61" data-size="39" style="height: 39px; width: 39px; line-height: 38px;">
                                            <span class="percent" style="font-size: 40px;"><?php echo $totalIklanPakai; ?></span>
                                        <canvas height="39" width="39"></canvas></div>

                                    <!-- /section:pages/dashboard.infobox.easypiechart -->
                                </div>

                                <div class="infobox-data">
                                    <div class="infobox-content">Active</div>
                                    <div class="infobox-content">Ads Slot</div>
                                </div>
                            </div>
                            <div class="infobox infobox-red infobox-small infobox-dark">
                                <div class="infobox-progress">
                                    <!-- #section:pages/dashboard.infobox.easypiechart -->
                                    <div class="easy-pie-chart percentage" data-percent="61" data-size="39" style="height: 39px; width: 39px; line-height: 38px;">
                                        <span class="percent" style="font-size: 40px;"><?php echo $totalIklanSisa; ?></span>
                                        <canvas height="39" width="39"></canvas></div>

                                    <!-- /section:pages/dashboard.infobox.easypiechart -->
                                </div>

                                <div class="infobox-data">
                                    <div class="infobox-content">Remaining</div>
                                    <div class="infobox-content">Ads Slot</div>
                                </div>
                            </div>
                            <div class="infobox infobox-blue infobox-small infobox-dark">
                                <div class="infobox-progress">
                                    <!-- #section:pages/dashboard.infobox.easypiechart -->
                                    <div class="easy-pie-chart percentage" data-percent="61" data-size="39" style="height: 39px; width: 39px; line-height: 38px;">
                                        <span class="percent" style="font-size: 40px;"><?php echo $totalIklan; ?></span>
                                        <canvas height="39" width="39"></canvas></div>

                                    <!-- /section:pages/dashboard.infobox.easypiechart -->
                                </div>

                                <div class="infobox-data">
                                    <div class="infobox-content">Total</div>
                                    <div class="infobox-content">Ads Slot</div>
                                </div>
                            </div>


                        </div>

                        <div class="vspace-12-sm"></div>

                        <div class="col-sm-5">
                            <div class="widget-box">
                                <div class="widget-header">
                                    <h5 class="widget-title">
                                        <i class="ace-icon fa fa-google-wallet"></i>
                                        Wallet
                                    </h5>


                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">

                                                <tr>
                                                    <th>Type</th>
                                                    <th>Total</th>
                                                </tr>
                                                <tr>
                                                    <th>E-Wallet</th>
                                                    <th>RM <?php echo number_format($this->m_umum->getWalletAmount(),2); ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Stokist Saldo</th>
                                                    <th>RM <?php echo number_format($this->m_member->getStokistBalance($detailUser->MemberID)); ?></th>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="hr hr8 hr-double" style="display: none;"></div>

                                        <div class="clearfix" style="display: none;">
                                            <div class="grid3">
                                                <span class="grey">
                                                    <i class="ace-icon fa fa-facebook-square fa-2x blue"></i>
                                                    &nbsp; likes
                                                </span>
                                                <h4 class="bigger pull-right">1,255</h4>
                                            </div>

                                            <div class="grid3">
                                                <span class="grey">
                                                    <i class="ace-icon fa fa-twitter-square fa-2x purple"></i>
                                                    &nbsp; tweets
                                                </span>
                                                <h4 class="bigger pull-right">941</h4>
                                            </div>

                                            <div class="grid3">
                                                <span class="grey">
                                                    <i class="ace-icon fa fa-pinterest-square fa-2x red"></i>
                                                    &nbsp; pins
                                                </span>
                                                <h4 class="bigger pull-right">1,050</h4>
                                            </div>
                                        </div>
                                    </div><!-- /.widget-main -->
                                </div><!-- /.widget-body -->
                            </div><!-- /.widget-box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="hr hr32 hr-dotted"></div>

                    <div class="row">
                        <div class="col-sm-7">
                            <div class="widget-box">
                                <div class="widget-header">
                                    <h5 class="widget-title">
                                        <i class="ace-icon fa fa-user"></i>
                                        Personal Information
                                    </h5>


                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">

                                                <tr>
                                                    <th>Refferal URL</th>
                                                    <th><?php echo base_url()."?agent=".$detailUser->UniqueCode; ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Name</th>
                                                    <th><?php echo $detailUser->FirstName ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Username</th>
                                                    <th><?php echo $detailUser->Username ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Mobile Phone</th>
                                                    <th><?php echo $detailUser->PhoneNumber ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <th><?php echo $detailUser->Email ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Package</th>
                                                    <th><?php echo $detailUser->PackageName ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Membership</th>
                                                    <th><?php echo ($detailUser->IsStokist==0) ? "MEMBER" : "TRADER"; ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Date Activated</th>
                                                    <th><?php echo $this->m_umum->formatTanggal($detailUser->ActiveDate); ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Date Expired</th>
                                                    <th><?php echo $this->m_umum->formatTanggal($detailUser->ExpiredDate); ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Sponsor</th>
                                                    <th><?php echo $this->m_member->getUsernameByID($detailUser->OriRefMemberID); ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Introducer</th>
                                                    <th><?php echo $this->m_member->getUsernameByID($detailUser->ActiveBy); ?></th> 
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="hr hr8 hr-double" style="display: none;"></div>

                                        <div class="clearfix" style="display: none;">
                                            <div class="grid3">
                                                <span class="grey">
                                                    <i class="ace-icon fa fa-facebook-square fa-2x blue"></i>
                                                    &nbsp; likes
                                                </span>
                                                <h4 class="bigger pull-right">1,255</h4>
                                            </div>

                                            <div class="grid3">
                                                <span class="grey">
                                                    <i class="ace-icon fa fa-twitter-square fa-2x purple"></i>
                                                    &nbsp; tweets
                                                </span>
                                                <h4 class="bigger pull-right">941</h4>
                                            </div>

                                            <div class="grid3">
                                                <span class="grey">
                                                    <i class="ace-icon fa fa-pinterest-square fa-2x red"></i>
                                                    &nbsp; pins
                                                </span>
                                                <h4 class="bigger pull-right">1,050</h4>
                                            </div>
                                        </div>
                                    </div><!-- /.widget-main -->
                                </div><!-- /.widget-body -->
                            </div><!-- /.widget-box -->
                        </div><!-- /.col -->

                        <div class="col-sm-5">
                            <div class="col-xs-12 col-sm-12 no-padding">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h5 class="widget-title">
                                            <i class="ace-icon fa fa-gift"></i>
                                            Bonus Summary
                                        </h5>


                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">

                                                    <tr>
                                                        <th>Sponsor</th>
                                                        <th>RM <?php echo  number_format($totalIntroducer,2); ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Unilevel</th>
                                                        <th>RM <?php echo number_format($totalUnilevel,2); ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Stokist Activation</th>
                                                        <th>RM <?php echo number_format($totalStokist,2) ?></th>
                                                    </tr>
                                                    
                                                </table>
                                            </div>

                                            <div class="hr hr8 hr-double" style="display: none;"></div>

                                            <div class="clearfix" style="display: none;">
                                                <div class="grid3">
                                                    <span class="grey">
                                                        <i class="ace-icon fa fa-facebook-square fa-2x blue"></i>
                                                        &nbsp; likes
                                                    </span>
                                                    <h4 class="bigger pull-right">1,255</h4>
                                                </div>

                                                <div class="grid3">
                                                    <span class="grey">
                                                        <i class="ace-icon fa fa-twitter-square fa-2x purple"></i>
                                                        &nbsp; tweets
                                                    </span>
                                                    <h4 class="bigger pull-right">941</h4>
                                                </div>

                                                <div class="grid3">
                                                    <span class="grey">
                                                        <i class="ace-icon fa fa-pinterest-square fa-2x red"></i>
                                                        &nbsp; pins
                                                    </span>
                                                    <h4 class="bigger pull-right">1,050</h4>
                                                </div>
                                            </div>
                                        </div><!-- /.widget-main -->
                                    </div><!-- /.widget-body -->
                                </div><!-- /.widget-box -->
                            </div>
                           
                            <div class="col-xs-12 col-sm-12 no-padding" style="margin-top: 20px;">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h5 class="widget-title">
                                            <i class="ace-icon fa fa-download"></i>
                                            Withdrawal
                                        </h5>


                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">

                                                    <tr>
                                                        <th>Success Withdrawal</th>
                                                        <th>RM <?php echo  number_format($totalSuksesWithdraw,2); ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Pending Withdrawal</th>
                                                        <th>RM <?php echo  number_format($totalPendingWithdraw,2); ?></th>
                                                    </tr>
                                                   
                                                </table>
                                            </div>

                                            <div class="hr hr8 hr-double" style="display: none;"></div>

                                            <div class="clearfix" style="display: none;">
                                                <div class="grid3">
                                                    <span class="grey">
                                                        <i class="ace-icon fa fa-facebook-square fa-2x blue"></i>
                                                        &nbsp; likes
                                                    </span>
                                                    <h4 class="bigger pull-right">1,255</h4>
                                                </div>

                                                <div class="grid3">
                                                    <span class="grey">
                                                        <i class="ace-icon fa fa-twitter-square fa-2x purple"></i>
                                                        &nbsp; tweets
                                                    </span>
                                                    <h4 class="bigger pull-right">941</h4>
                                                </div>

                                                <div class="grid3">
                                                    <span class="grey">
                                                        <i class="ace-icon fa fa-pinterest-square fa-2x red"></i>
                                                        &nbsp; pins
                                                    </span>
                                                    <h4 class="bigger pull-right">1,050</h4>
                                                </div>
                                            </div>
                                        </div><!-- /.widget-main -->
                                    </div><!-- /.widget-body -->
                                </div><!-- /.widget-box -->
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->




                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div> 
</div>
<script>
    function klikMenu(kemana) {
        location.href = kemana;
    }
</script>