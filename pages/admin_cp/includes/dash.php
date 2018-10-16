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
                <li><a href="?page=admin_cp" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li><a href="?page=admin_cp&action=website_management" class=""><i class="lnr lnr-code"></i> <span>Website Management</span></a></li>
            </ul>
        </nav>
    </div>
</div>


<div class="main">

    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Welcome to ScapeRune's Admin Control Panel!</h3>
                </div>

                <div class="panel-body">
                    As part of the website rewrite, we have introduced a new, slick admin control panel design.
                    <br>
                    <hr>
                    In this control panel, you will have the ability to do many things such as the following:
                    <ul>
                        <li>Create & edit news posts</li>
                        <li>Manage & create forums</li>
                        <li>Account management</li>
                        <li><b>More coming soon...</b></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
