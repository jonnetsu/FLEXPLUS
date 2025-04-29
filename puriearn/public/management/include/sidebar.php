<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="dashboard.php" class="app-brand-link">
          <img src="assets/img/favicon/logo.png"  class="logo" style="width:150px !important"/>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item active">
            <a href="dashboard.php" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Dashboard</div>
            </a>
          </li>

        

          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Users</span>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-user"></i>
              <div data-i18n="Account Settings">Users</div>
            </a>
            <ul class="menu-sub">                
              <li class="menu-item">
                <a href="users.php" class="menu-link">
                  <div data-i18n="Notifications">All Users</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="vendors.php" class="menu-link">
                  <div data-i18n="Notifications">Vendors</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="cashback-bonus.php" class="menu-link">
                  <div data-i18n="Notifications">Cashback Bonus</div>
                </a>
              </li>
            </ul>
          </li>
          <!-- Revenue -->
          <li class="menu-header small text-uppercase"><span class="menu-header-text">Job Adverts</span></li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-note"></i>
              <div data-i18n="Form Elements">Categories</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="add-category.php" class="menu-link">
                  <div data-i18n="Input groups">New Category</div>
                </a>
              </li>
              
              <li class="menu-item">
                <a href="categories.php" class="menu-link">
                  <div data-i18n="Input groups">All Categories</div>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-note"></i>
              <div data-i18n="Form Elements">Sub Categories</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="add-sub-category.php" class="menu-link">
                  <div data-i18n="Input groups">New Sub Category</div>
                </a>
              </li>
              
              <li class="menu-item">
                <a href="sub-categories.php" class="menu-link">
                  <div data-i18n="Input groups">All Sub Categories</div>
                </a>
              </li>
             
            </ul>
          </li>
          <!-- Users -->
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-money"></i>
              <div data-i18n="Form Elements">Job Adverts</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item">
                <a href="pending-ads.php" class="menu-link">
                  <div data-i18n="Input groups">Pending Ads</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="verified-ads.php" class="menu-link">
                  <div data-i18n="Input groups">Verified Ads</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="pending-job-review.php" class="menu-link">
                  <div data-i18n="Input groups">Pending Job Review</div>
                </a>
              </li>
              
              <li class="menu-item">
                <a href="completed-job-review.php" class="menu-link">
                  <div data-i18n="Input groups">Confirmed Job Review</div>
                </a>
              </li>
             
            </ul>
          </li>
        
           <!-- Revenue -->
           <li class="menu-header small text-uppercase"><span class="menu-header-text">Payouts</span></li>
          <!-- Users -->
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-money"></i>
              <div data-i18n="Form Elements">Withdrawals</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="pending-withdrawals.php" class="menu-link">
                  <div data-i18n="Input groups">Pending Affiliate Withdrawals</div>
                </a>
              </li>
              
              <li class="menu-item">
                <a href="pending-job-withdrawals.php" class="menu-link">
                  <div data-i18n="Input groups">Pending Job Withdrawals</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="pending-tiktok-withdrawals.php" class="menu-link">
                  <div data-i18n="Input groups">Pending Tiktok Withdrawals</div>
                </a>
              </li>
             
              <li class="menu-item">
                <a href="confirmed-withdrawals.php" class="menu-link">
                  <div data-i18n="Input groups">Confirmed Withdrawals</div>
                </a>
              </li>
             
            </ul>
          </li>
        
            <!-- Revenue -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Tasks</span></li>
          <!-- Users -->
          <li class="menu-item">
           
           <!-- Tiktok Task -->
           <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-edit"></i>
              <div data-i18n="Form Elements">Tiktok Tasks </div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="add-tiktok-task.php" class="menu-link">
                  <div data-i18n="Input groups">Add Task</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="all-tiktok-tasks.php" class="menu-link">
                  <div data-i18n="Input groups">All Tasks</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="pending-tiktok-tasks.php" class="menu-link">
                  <div data-i18n="Input groups">Pending Task Review</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="confirmed-tiktok-tasks.php" class="menu-link">
                  <div data-i18n="Input groups">Reviewed Tasks</div>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="menu-item active">
            <a href="portals.php" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Withdrawal Portal</div>
            </a>
          </li>

         
            <!-- Revenue -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Extras</span></li>
          <!-- Users -->
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-box"></i>
              <div data-i18n="Form Elements">Extras</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="add-banner.php" class="menu-link">
                  <div data-i18n="Input groups">New Banner</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="banners.php" class="menu-link">
                  <div data-i18n="Input groups">All Banners</div>
                </a>
              </li>
            </ul>
          </li>
           <!-- Users -->
           <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-box"></i>
              <div data-i18n="Form Elements">Coupons</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="generate-coupon.php" class="menu-link">
                  <div data-i18n="Input groups">Generate Codes</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="all-coupons.php" class="menu-link">
                  <div data-i18n="Input groups">All Coupons</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="code-check.php" class="menu-link">
                  <div data-i18n="Input groups">Coupon Check</div>
                </a>
              </li>
            </ul>
          </li>
           <!-- Course -->
           <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-book"></i>
              <div data-i18n="Form Elements">Courses</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="add-course.php" class="menu-link">
                  <div data-i18n="Input groups">Add Course</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="courses.php" class="menu-link">
                  <div data-i18n="Input groups">All Courses</div>
                </a>
              </li>
             
            </ul>
          </li>
          
        
            <!-- Users -->
            <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-bell"></i>
              <div data-i18n="Form Elements">Notifications</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="add-notification.php" class="menu-link">
                  <div data-i18n="Input groups">New Notification</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="all-notifications.php" class="menu-link">
                  <div data-i18n="Input groups">All Notifications</div>
                </a>
              </li>
              
              </ul>
          </li>
            <!-- Users -->
            <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-link"></i>
              <div data-i18n="Form Elements">Social Links</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="add-link.php" class="menu-link">
                  <div data-i18n="Input groups">New Link</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="all-links.php" class="menu-link">
                  <div data-i18n="Input groups">All Links</div>
                </a>
              </li>
              
              </ul>
          </li>
          <!-- Authentication -->
          <li class="menu-header small text-uppercase"><span class="menu-header-text">Authentication</span></li>
           <!-- Service Provider -->
           <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-lock-open"></i>
              <div data-i18n="User interface">Admins</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item">
                <a href="add-admin.php" class="menu-link">
                  <div data-i18n="Alerts">Add Admin</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="admins.php" class="menu-link">
                  <div data-i18n="Accordion">All Admins</div>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="menu-item">
            <a
              href="my-account.php"
              class="menu-link"
            >
            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
              <div data-i18n="Support">My Account</div>
            </a>
          </li>
          <li class="menu-item">
            <a
              href="logout.php"
              class="menu-link"
            >
              <i class="menu-icon tf-icons bx bx-user"></i>
              <div data-i18n="Support">Log Out</div>
            </a>
          </li>
        </ul>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav
          class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar"
        >
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input
                  type="text"
                  class="form-control border-0 shadow-none"
                  placeholder="Search..."
                  aria-label="Search..."
                />
              </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- Place this tag where you want the button to render. -->
              

              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-admin">
                    <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block"><?php echo $_SESSION['name']?></span>
                          <small class="text-muted">Admin</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="my-account.php">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  </li>
                 
                  <li>
                    <a class="dropdown-item" href="add-admin.php">
                      <span class="d-flex align-items-center align-middle">
                        <i class="flex-shrink-0 bx bx-user-plus me-2"></i>
                        <span class="flex-grow-1 align-middle">New Admin</span>
                       
                      </span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="logout.php">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->
