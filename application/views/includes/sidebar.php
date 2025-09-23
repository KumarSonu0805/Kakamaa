
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar <?= SIDEBAR_COLOR ?> elevation-4">
                <!-- Brand Logo -->
                <a href="<?= base_url(); ?>" class="brand-link">
                    <img src="<?= file_url('assets/images/icon.png') ?>" alt="<?= PROJECT_NAME ?> Logo" class="brand-image bg-white img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light"><?= PROJECT_NAME ?></span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="<?=file_url('includes/dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"><?= $this->session->name; ?></a>
                        </div>
                    </div>

                    <!-- SidebarSearch Form -->
                    <div class="form-inline d-none">
                        <div class="input-group" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar nav-compact flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="<?= base_url('home/'); ?>" class="nav-link <?= activate_menu('home'); ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Home</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview <?= activate_dropdown('masterkey'); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('masterkey','a'); ?>">
                                    <i class="nav-icon fas fa-key"></i>
                                    <p>Master Key <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('masterkey/'); ?>" class="nav-link <?= activate_menu('masterkey'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>State</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('masterkey/district/'); ?>" class="nav-link <?= activate_menu('masterkey/district'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>District</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('masterkey/area/'); ?>" class="nav-link <?= activate_menu('masterkey/area'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Area</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('masterkey/servicetype/'); ?>" class="nav-link <?= activate_menu('masterkey/servicetype'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Service Type</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('masterkey/service/'); ?>" class="nav-link <?= activate_menu('masterkey/service'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Service</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('masterkey/paymenttype/'); ?>" class="nav-link <?= activate_menu('masterkey/paymenttype'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Payment App</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('masterkey/category/'); ?>" class="nav-link <?= activate_menu('masterkey/category'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Category</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('masterkey/bank/'); ?>" class="nav-link <?= activate_menu('masterkey/bank'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Banks</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                            $not=array('kycrequests','approvedkyc','franchisekycrequests','approvedfranchisekyc');
                            ?>
                            <li class="nav-item has-treeview <?= activate_dropdown('members','li',$not); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('members','a',$not); ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>My Team<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('members/memberlist/'); ?>" class="nav-link <?= activate_menu('members/memberlist'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Member List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('members/memberactivationlist/'); ?>" class="nav-link <?= activate_menu('members/memberactivationlist'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Member Activation List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('members/packageupgradelist/'); ?>" class="nav-link <?= activate_menu('members/packageupgradelist'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Package Upgrade List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                            $not=['kycrequests','approvedkyc'];
                            ?>
                            <li class="nav-item has-treeview <?= activate_dropdown('franchise','li',$not); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('franchise','a',$not); ?>">
                                    <i class="nav-icon fas fa-store"></i>
                                    <p>Franchise<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('franchise/'); ?>" class="nav-link <?= activate_menu('franchise'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Franchise</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('franchise/franchiselist/'); ?>" class="nav-link <?= activate_menu('franchise/franchiselist'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Franchise List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                            $not=array('memberlist','memberactivationlist','packageupgradelist','franchiselist','index');
                            ?>
                            <li class="nav-item has-treeview <?= activate_dropdown(['members','franchise'],'li',$not); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown(['members','franchise'],'a',$not); ?>">
                                    <i class="nav-icon fas fa-file-signature"></i>
                                    <p>KYC<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('members/kycrequests/'); ?>" class="nav-link <?= activate_menu('members/kycrequests'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Member KYC Requests</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('members/approvedkyc/'); ?>" class="nav-link <?= activate_menu('members/approvedkyc'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Approved Member KYC</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('franchise/kycrequests/'); ?>" class="nav-link <?= activate_menu('franchise/kycrequests'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Franchise KYC Requests</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('franchise/approvedkyc/'); ?>" class="nav-link <?= activate_menu('franchise/approvedkyc'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Approved Franchise KYC</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview <?= activate_dropdown('repurchases'); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('repurchases','a'); ?>">
                                    <i class="nav-icon fas fa-cart-arrow-down"></i>
                                    <p>Repurchase<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('repurchases/'); ?>" class="nav-link <?= activate_menu('repurchases'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Repurchase</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('repurchases/repurchaselist/'); ?>" class="nav-link <?= activate_menu('repurchases/repurchaselist'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Repurchase List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview <?= activate_dropdown('royalty'); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('royalty','a'); ?>">
                                    <i class="nav-icon fas fa-crown"></i>
                                    <p>Achievers<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('royalty/'); ?>" class="nav-link <?= activate_menu('royalty'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Royalty Member</p>
                                        </a>
                                    </li>
                                    <?php
                                    $royalty=getroyalty();
                                    if(!empty($royalty)){
                                        foreach($royalty as $r){
                                    ?>
                                    <li class="nav-item">
                                        <a href="<?= base_url('royalty/'.generate_slug($r['name']).'-list/'); ?>" class="nav-link <?= activate_menu('royalty/repurchaselist'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p><?= $r['name'].' Achiever List'; ?></p>
                                        </a>
                                    </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview <?= activate_dropdown('funds'); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('funds','a'); ?>">
                                    <i class="nav-icon fas fa-crown"></i>
                                    <p>Fund Achievers<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('funds/'); ?>" class="nav-link <?= activate_menu('funds'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>All Achievers</p>
                                        </a>
                                    </li>
                                    <?php
                                    $funds=getfunds();
                                    if(!empty($funds)){
                                        foreach($funds as $f){
                                    ?>
                                    <li class="nav-item">
                                        <a href="<?= base_url('funds/'.generate_slug($f['name']).'-list/'); ?>" class="nav-link <?= activate_menu('funds/repurchaselist'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p><?= $f['name'].' Achiever List'; ?></p>
                                        </a>
                                    </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview d-none <?= activate_dropdown('members'); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('members','a'); ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Members <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url("members/"); ?>" class="nav-link <?= activate_menu('members'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Member Registration</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url("members/memberlist/"); ?>" class="nav-link <?= activate_menu('members/memberlist'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Member List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url("members/treeview/"); ?>" class="nav-link <?= activate_menu('members/treeview'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Member Tree</p>
                                        </a>
                                    </li>
                                    <?php /*?><li class="nav-item">
                                        <a href="<?= base_url("members/activelist/"); ?>" class="nav-link <?= activate_menu('members/activelist'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Active Member List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url("members/inactivelist/"); ?>" class="nav-link <?= activate_menu('members/inactivelist'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>In-Active Member List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url("members/renewals/"); ?>" class="nav-link <?= activate_menu('members/renewals'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Member Renewals</p>
                                        </a>
                                    </li><?php */?>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview <?= activate_dropdown('packages','li',['royalty','fund','repurchase','recharge','billpayment']); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('packages','a',['royalty','fund','repurchase','recharge','billpayment']); ?>">
                                    <i class="nav-icon fas fa-ticket-alt"></i>
                                    <p>Packages<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('packages/'); ?>" class="nav-link <?= activate_menu('packages'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Packages</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('packages/leveldistribution/'); ?>" class="nav-link <?= activate_menu('packages/leveldistribution'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Level Distribution</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('packages/franchisedistribution/'); ?>" class="nav-link <?= activate_menu('packages/franchisedistribution'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Franchise Distribution</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview <?= activate_dropdown('packages','li',['index','leveldistribution','franchisedistribution']); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('packages','a',['index','leveldistribution','franchisedistribution']); ?>">
                                    <i class="nav-icon fas fa-money-bill"></i>
                                    <p>Income Distribution<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('packages/royalty/'); ?>" class="nav-link <?= activate_menu('packages/royalty'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Royalty Distribution</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('packages/fund/'); ?>" class="nav-link <?= activate_menu('packages/fund'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Fund Distribution</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('packages/repurchase/'); ?>" class="nav-link <?= activate_menu('packages/repurchase'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Repurchase Distribution</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('packages/recharge/'); ?>" class="nav-link <?= activate_menu('packages/recharge'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Recharge Distribution</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('packages/billpayment/'); ?>" class="nav-link <?= activate_menu('packages/billpayment'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Bill Payment Distribution</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('referearn/'); ?>" class="nav-link <?= activate_menu('referearn'); ?>">
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>Refer &amp; Earn</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview <?= activate_dropdown('settings'); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('settings','a'); ?>">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>Settings<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('settings/'); ?>" class="nav-link <?= activate_menu('settings'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>General</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('settings/adminaccdetails/'); ?>" class="nav-link <?= activate_menu('settings/adminaccdetails'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Admin Bank Details</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('settings/rechargelimit/'); ?>" class="nav-link <?= activate_menu('settings/rechargelimit'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Recharge/Bill Payment Limit</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item <?= activate_dropdown('customize'); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('customize','a'); ?>">
                                    <i class="nav-icon fas fa-wrench"></i>
                                    <p>
                                        Customize
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('customize/'); ?>" class="nav-link <?= activate_menu('customize'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Banner Images</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('customize/referralimage/'); ?>" class="nav-link <?= activate_menu('customize/referralimage'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Referral Image</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('customize/customization/'); ?>" class="nav-link <?= activate_menu('customize/customization'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Home Customization</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('customize/category/'); ?>" class="nav-link <?= activate_menu('customize/category'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Gallery Category</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('customize/gallery/'); ?>" class="nav-link <?= activate_menu('customize/gallery'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Gallery</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                                $not=['fundrequests','approvedfundrequests','withdrawalrequests','approvedwithdrawalrequests',
                                      'addbusiness','businesshistory','franchisefundrequests','franchisewallet','franchisewallethistory','fwallethistory'];
                            ?>
                            <li class="nav-item <?= activate_dropdown('wallet','li',$not); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('wallet','a',$not); ?>">
                                    <i class="nav-icon fas fa-wallet"></i>
                                    <p>
                                        Member Wallet
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('wallet/memberwallet/'); ?>" class="nav-link <?= activate_menu('wallet/memberwallet'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Member Wallet</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('wallet/memberwallethistory/'); ?>" class="nav-link <?= activate_menu('wallet/memberwallethistory'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Credit/Debit History</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                                $not=['fundrequests','approvedfundrequests','withdrawalrequests','approvedwithdrawalrequests',
                                      'addbusiness','businesshistory','franchisefundrequests','memberwallet','memberwallethistory','wallethistory'];
                            ?>
                            <li class="nav-item <?= activate_dropdown('wallet','li',$not); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('wallet','a',$not); ?>">
                                    <i class="nav-icon fas fa-wallet"></i>
                                    <p>
                                        Franchise Wallet
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('wallet/franchisewallet/'); ?>" class="nav-link <?= activate_menu('wallet/franchisewallet'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Franchise Wallet</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('wallet/franchisewallethistory/'); ?>" class="nav-link <?= activate_menu('wallet/franchisewallethistory'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Credit/Debit History</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                                $not=['fundrequests','approvedfundrequests','withdrawalrequests','approvedwithdrawalrequests',
                                     'memberwallet','memberwallethistory','creditdebit','franchisefundrequests','franchisewallet','franchisewallethistory','wallethistory','fwallethistory'];
                            ?>
                            <li class="nav-item <?= activate_dropdown('wallet','li',$not); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('wallet','a',$not); ?>">
                                    <i class="nav-icon fas fa-wallet"></i>
                                    <p>
                                        Daily Business
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('wallet/addbusiness/'); ?>" class="nav-link <?= activate_menu('wallet/addbusiness'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Business</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('wallet/businesshistory/'); ?>" class="nav-link <?= activate_menu('wallet/businesshistory'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Daily Business History</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                                $not=['memberwallet','memberwallethistory','addbusiness','businesshistory','creditdebit','franchisewallet','franchisewallethistory','wallethistory','fwallethistory'];
                            ?>
                            <li class="nav-item <?= activate_dropdown('wallet','li',$not); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('wallet','a',$not); ?>">
                                    <i class="nav-icon fas fa-wallet"></i>
                                    <p>
                                        Wallet
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('wallet/fundrequests/'); ?>" class="nav-link <?= activate_menu('wallet/fundrequests'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Fund Requests</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('wallet/franchisefundrequests/'); ?>" class="nav-link <?= activate_menu('wallet/franchisefundrequests'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Franchise Fund Requests</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('wallet/approvedfundrequests/'); ?>" class="nav-link <?= activate_menu('wallet/approvedfundrequests'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Approved Fund Requests</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('wallet/withdrawalrequests/'); ?>" class="nav-link <?= activate_menu('wallet/withdrawalrequests'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Withdrawal Requests</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('wallet/approvedwithdrawalrequests/'); ?>" class="nav-link <?= activate_menu('wallet/approvedwithdrawalrequests'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Approved Withdrawals</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                                $not=[];
                            ?>
                            <li class="nav-item <?= activate_dropdown('recharge','li',$not); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('recharge','a',$not); ?>">
                                    <i class="nav-icon fas fa-file-invoice"></i>
                                    <p>
                                        Recharge/Bill Payment
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('recharge/plans/'); ?>" class="nav-link <?= activate_menu('recharge/plans'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Prepaid Recharge Plans</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('recharge/'); ?>" class="nav-link <?= activate_menu('recharge'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Prepaid Recharge History</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('recharge/dthrecharge/'); ?>" class="nav-link <?= activate_menu('recharge/dthrecharge'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>DTH Recharge History</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('recharge/billpayment/'); ?>" class="nav-link <?= activate_menu('recharge/billpayment'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Bill Payment History</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                                $not=[];
                            ?>
                            <li class="nav-item <?= activate_dropdown('billers','li',$not); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('billers','a',$not); ?>">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>
                                        Billers
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('billers/'); ?>" class="nav-link <?= activate_menu('billers'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Biller List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('billers/category/'); ?>" class="nav-link <?= activate_menu('billers/category'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Biller Category</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('billers/importbillers/'); ?>" class="nav-link <?= activate_menu('billers/importbillers'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Import Billers</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item <?= activate_dropdown('leaderboard','li',$not); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('leaderboard','a',$not); ?>">
                                    <i class="nav-icon fas fa-wallet"></i>
                                    <p>
                                        Leaderboard
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('leaderboard/'); ?>" class="nav-link <?= activate_menu('leaderboard'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Leaderboard</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('leaderboard/events/'); ?>" class="nav-link <?= activate_menu('leaderboard/events'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Events</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('scratchcards/'); ?>" class="nav-link <?= activate_menu('scratchcards'); ?>">
                                    <i class="nav-icon fas fa-chess-board"></i>
                                    <p>Scratch Cards</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
