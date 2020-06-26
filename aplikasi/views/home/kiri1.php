			<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="<?=base_url()?>"><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>         Dashboard</a>
							
                            <div class="sb-sidenav-menu-heading">Menus</div>
							<?php foreach ($data->result() as $menu_item): ?>
								<nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="<?php echo site_url($menu_item->menu.'/index'); ?>"><div class="sb-nav-link-icon"><i class="far fa-circle nav-icon"></i></div><?php echo $menu_item->description; ?></a></nav>
							<?php endforeach; ?>
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
								<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Report
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
									<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
										<nav class="sb-sidenav-menu-nested nav">
											<?php foreach ($tes->result() as $menu_item1): ?>
												<a class="nav-link" href="<?php echo site_url($menu_item1->menu.'/index'); ?>"><?php echo $menu_item1->description; ?></a>
											<?php endforeach; ?>
										</nav>
									</div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <div class="medium"><?php echo $this->session->userdata('user_name'); ?></div>
                    </div>
                </nav>
            </div>
