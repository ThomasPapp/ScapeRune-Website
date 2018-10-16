<?php
/**
 * @author Thomas
 */
if (count(get_required_files()) <= 1) {
    header("Location: ?page=main");
    exit;
}
?>

<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="?page=admin_cp" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li><a href="?page=admin_cp&action=website_management" class="active"><i class="lnr lnr-code"></i> <span>Website Management</span></a></li>
            </ul>
        </nav>
    </div>
</div>

<div class="main">

    <div class="main-content">
        <div class="container-fluid">
            <h3 class="page-title">Website Management</h3>


            <div class="row">
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Create News Post</h3>
                        </div>
                        <div class="panel-body">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
